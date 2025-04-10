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

            // Crear la orden
            $order = new Order([
                'user_id' => Auth::id(),
                'status' => 'pending',
                'shipping_address' => $request->address,
                'shipping_city' => $request->city,
                'shipping_state' => $request->state,
                'shipping_postal_code' => $request->postal_code,
                'shipping_phone' => $request->phone,
                'total_amount' => $cart->items->sum('subtotal') + 10.00, // Subtotal + shipping
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

            // Procesar el pago con MercadoPago
            MercadoPagoConfig::setAccessToken(config('services.mercadopago.access_token'));
            $client = new PreferenceClient();

            $preference = $client->create([
                'items' => [
                    [
                        'title' => "Orden #{$order->id}",
                        'quantity' => 1,
                        'currency_id' => 'MXN',
                        'unit_price' => $order->total_amount,
                    ]
                ],
                'back_urls' => [
                    'success' => route('checkout.success', ['order' => $order->id]),
                    'failure' => route('checkout.failure', ['order' => $order->id]),
                    'pending' => route('checkout.pending', ['order' => $order->id]),
                ],
                'auto_return' => 'approved',
            ]);

            // Limpiar el carrito
            $cart->items()->delete();
            $cart->delete();

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