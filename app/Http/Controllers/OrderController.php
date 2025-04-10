<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Cart;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    public function index(): View
    {
        $orders = Auth::user()->isAdmin()
            ? Order::with(['user', 'items.product'])->latest()->paginate(10)
            : Auth::user()->orders()->with(['items.product'])->latest()->paginate(10);

        return view('orders.index', compact('orders'));
    }

    public function show(Order $order): View
    {
        if (!Auth::user()->isAdmin() && $order->user_id !== Auth::id()) {
            abort(403);
        }

        return view('orders.show', compact('order'));
    }

    public function create(): View
    {
        $cart = Cart::where('user_id', Auth::id())
            ->where('status', 'active')
            ->firstOrFail();

        if ($cart->items->isEmpty()) {
            return redirect()->route('cart.index')
                ->with('error', 'El carrito está vacío.');
        }

        return view('orders.create', compact('cart'));
    }

    public function store(Request $request): RedirectResponse
    {
        $cart = Cart::where('user_id', Auth::id())
            ->where('status', 'active')
            ->firstOrFail();

        if ($cart->items->isEmpty()) {
            return redirect()->route('cart.index')
                ->with('error', 'El carrito está vacío.');
        }

        $validated = $request->validate([
            'address' => 'required|string',
            'city' => 'required|string',
            'postal_code' => 'required|string',
            'phone' => 'required|string',
            'payment_method' => 'required|in:card,cash'
        ]);

        try {
            DB::beginTransaction();

            // Verificar stock antes de crear la orden
            foreach ($cart->items as $item) {
                if ($item->quantity > $item->product->stock) {
                    throw new \Exception("Stock insuficiente para {$item->product->name}");
                }
            }

            $order = Order::create([
                'user_id' => Auth::id(),
                'total' => $cart->total,
                'status' => 'pending',
                'shipping_address' => $validated['address'],
                'shipping_city' => $validated['city'],
                'shipping_zip_code' => $validated['postal_code'],
                'shipping_phone' => $validated['phone'],
                'payment_method' => $validated['payment_method']
            ]);

            // Crear items de la orden y actualizar stock
            foreach ($cart->items as $item) {
                $order->items()->create([
                    'product_id' => $item->product_id,
                    'quantity' => $item->quantity,
                    'price' => $item->price
                ]);

                $item->product->decrement('stock', $item->quantity);
            }

            // Marcar el carrito como procesado
            $cart->update(['status' => 'processed']);

            DB::commit();

            return redirect()->route('orders.show', $order)
                ->with('success', 'Pedido creado exitosamente.');

        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', $e->getMessage());
        }
    }

    public function updateStatus(Request $request, Order $order): RedirectResponse
    {
        if (!Auth::user()->isAdmin()) {
            abort(403);
        }

        $validated = $request->validate([
            'status' => 'required|in:pending,processing,completed,cancelled'
        ]);

        $order->update(['status' => $validated['status']]);

        return back()->with('success', 'Estado del pedido actualizado exitosamente.');
    }
}