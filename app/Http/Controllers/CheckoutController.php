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
            DB::beginTransaction();

            // Validar el stock nuevamente
            $cart = Cart::where('user_id', Auth::id())
                ->with('items.product')
                ->firstOrFail();

            foreach ($cart->items as $item) {
                if ($item->quantity > $item->product->stock) {
                    throw new \Exception("Stock insuficiente para {$item->product->name}");
                }
            }

            $subtotal = $cart->items->sum('subtotal');
            $shipping = $request->shipping_method === 'delivery' ? 10.00 : 0.00;
            $total = ($subtotal + $shipping) * 1.19; // Incluye IVA

            // Crear la orden
            $order = new Order([
                'user_id' => Auth::id(),
                'status' => $request->payment_method === 'cash' ? 'pending_pickup' : 'pending',
                'payment_method' => $request->payment_method,
                'shipping_method' => $request->shipping_method,
                'shipping_address' => $request->street,
                'shipping_city' => $request->city,
                'shipping_state' => $request->state,
                'shipping_postal_code' => $request->postal_code,
                'shipping_phone' => $request->phone,
                'subtotal' => $subtotal,
                'shipping_cost' => $shipping,
                'tax' => ($subtotal + $shipping) * 0.19,
                'total_amount' => $total,
            ]);
            $order->save();

            // Crear los items de la orden y actualizar el stock
            foreach ($cart->items as $cartItem) {
                OrderItem::create([
                    'order_id' => $order->id,
                    'product_id' => $cartItem->product_id,
                    'quantity' => $cartItem->quantity,
                    'unit_price' => $cartItem->product->price,
                    'subtotal' => $cartItem->subtotal,
                ]);

                // Actualizar el stock
                $product = $cartItem->product;
                $product->stock -= $cartItem->quantity;
                $product->save();
            }

            // Limpiar el carrito
            $cart->items()->delete();
            $cart->delete();

            // Si el pago es en efectivo, redirigir a la página de éxito
            if ($request->payment_method === 'cash') {
                DB::commit();
                return response()->json([
                    'success' => true,
                    'redirect_url' => route('checkout.success', ['order' => $order->id]),
                ]);
            }

            // Procesar el pago con MercadoPago
\MercadoPago\SDK::setAccessToken(config('services.mercadopago.access_token'));
            $client = new PreferenceClient();

            $preference = $client->create([
                'items' => [
                    [
                        'title' => "Orden #{$order->id}",
                        'quantity' => 1,
                        'currency_id' => 'MXN',
                        'unit_price' => $total,
                    ]
                ],
                'external_reference' => (string) $order->id,
                'back_urls' => [
                    'success' => route('checkout.success', ['order' => $order->id]),
                    'failure' => route('checkout.failure', ['order' => $order->id]),
                    'pending' => route('checkout.pending', ['order' => $order->id]),
                ],
                'notification_url' => route('webhooks.mercadopago'),
                'auto_return' => 'approved',
            ]);

            DB::commit();

            return response()->json([
                'success' => true,
                'redirect_url' => $preference->init_point,
            ]);

        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'success' => false,
                'message' => $e->getMessage(),
            ], 500);
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