<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use MercadoPago\Client\Preference\PreferenceClient;
use MercadoPago\MercadoPagoConfig;

class CheckoutController extends Controller
{
    public function index()
    {
        $cart = Cart::where('user_id', Auth::id())->first();
        if (!$cart || $cart->items->isEmpty()) {
            return redirect()->route('cart.index')
                ->with('error', 'Tu carrito está vacío');
        }

        $cartItems = $cart->items()->with('product')->get();
        $subtotal = $cartItems->sum('subtotal');
        $shipping = 10.00; // Costo fijo de envío por ahora
        $total = $subtotal + $shipping;

        return view('checkout.index', compact('cartItems', 'subtotal', 'shipping', 'total'));
    }

    public function validateStock()
    {
        $cart = Cart::where('user_id', Auth::id())
            ->with('items.product')
            ->first();

        if (!$cart) {
            return response()->json(['valid' => false, 'message' => 'Carrito no encontrado']);
        }

        $valid = true;
        $message = '';

        foreach ($cart->items as $item) {
            if ($item->quantity > $item->product->stock) {
                $valid = false;
                $message = "No hay suficiente stock disponible para {$item->product->name}";
                break;
            }
        }

        return response()->json(['valid' => $valid, 'message' => $message]);
    }

    public function process(Request $request)
    {
        try {
            // Validar los datos del formulario
            $request->validate([
                'shipping_method' => 'required|in:delivery,pickup',
                'payment_method' => 'required|in:cash,mercadopago',
                'street' => 'required_if:shipping_method,delivery',
                'city' => 'required_if:shipping_method,delivery',
                'state' => 'required_if:shipping_method,delivery',
                'phone' => 'required'
            ]);

            DB::beginTransaction();

            // Validar el stock nuevamente
            $cart = Cart::where('user_id', Auth::id())
                ->with('items.product')
                ->firstOrFail();

            if ($cart->items->isEmpty()) {
                throw new \Exception('El carrito está vacío');
            }

            foreach ($cart->items as $item) {
                if ($item->quantity > $item->product->stock) {
                    throw new \Exception("Stock insuficiente para {$item->product->name}");
                }
            }

            $subtotal = $cart->items->sum(function ($item) {
                return $item->quantity * $item->product->price;
            });
            $shipping = $request->shipping_method === 'delivery' ? 10.00 : 0.00;
            $total = $subtotal + $shipping;

            // Generar número de orden único
            $orderNumber = Order::generateOrderNumber();

            // Crear la orden
            $order = new Order([
                'user_id' => Auth::id(),
                'order_number' => $orderNumber,
                'total' => $total,
                'status' => $request->payment_method === 'cash' ? 'pending_pickup' : 'pending',
                'payment_status' => 'pending',
                'payment_method' => $request->payment_method,
                'shipping_method' => $request->shipping_method,
                'shipping_name' => Auth::user()->name,
                'shipping_address' => $request->shipping_method === 'delivery' ? $request->street : 'Pickup in store',
                'shipping_city' => $request->shipping_method === 'delivery' ? $request->city : '',
                'shipping_state' => $request->shipping_method === 'delivery' ? $request->state : '',
                'shipping_zip' => $request->shipping_method === 'delivery' ? $request->postal_code : '',
                'shipping_phone' => $request->phone,
                'purchase_token' => hash('sha256', $orderNumber . time() . Auth::id()),
            ]);
            $order->save();

            // Crear los items de la orden y actualizar el stock
            foreach ($cart->items as $cartItem) {
                $product = $cartItem->product;
                
                // Verificar stock una última vez
                if ($cartItem->quantity > $product->stock) {
                    throw new \Exception("Stock insuficiente para {$product->name}");
                }

                // Crear item del pedido
                OrderItem::create([
                    'order_id' => $order->id,
                    'product_id' => $product->id,
                    'product_name' => $product->name,
                    'quantity' => $cartItem->quantity,
                    'price' => $product->price,
                    'subtotal' => $cartItem->quantity * $product->price
                ]);

                // Actualizar el stock
                $product->decrement('stock', $cartItem->quantity);
            }

            // Limpiar el carrito
            $cart->items()->delete();
            $cart->delete();

            // Procesar según el método de pago
            if ($request->payment_method === 'cash') {
                $order->payment_status = 'pending';
                $order->status = 'pending_pickup';
                $order->save();
                
                DB::commit();
                return redirect()->route('checkout.success', ['order' => $order->id]);
            }

            // Configurar MercadoPago
            MercadoPagoConfig::setAccessToken(config('services.mercadopago.access_token'));
            $client = new PreferenceClient();

            // Crear preferencia de pago
            $preference = $client->create([
                'items' => [
                    [
                        'title' => "Orden #{$order->order_number}",
                        'quantity' => 1,
                        'currency_id' => 'MXN',
                        'unit_price' => $total,
                        'description' => 'Compra en Ecomer Web'
                    ]
                ],
                'external_reference' => $order->purchase_token,
                'back_urls' => [
                    'success' => route('checkout.success', ['order' => $order->id]),
                    'failure' => route('checkout.failure', ['order' => $order->id]),
                    'pending' => route('checkout.pending', ['order' => $order->id])
                ],
                'notification_url' => route('webhooks.mercadopago'),
                'auto_return' => 'approved'
            ]);

            DB::commit();

            return redirect()->away($preference->init_point);

        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    public function success(Order $order)
    {
        if ($order->user_id !== Auth::id()) {
            abort(403);
        }

        $order->status = 'completed';
        $order->save();

        return view('checkout.success', compact('order'));
    }

    public function failure(Order $order)
    {
        if ($order->user_id !== Auth::id()) {
            abort(403);
        }

        $order->status = 'failed';
        $order->save();

        return view('checkout.failure', compact('order'));
    }

    public function pending(Order $order)
    {
        if ($order->user_id !== Auth::id()) {
            abort(403);
        }

        return view('checkout.pending', compact('order'));
    }
}