<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    /**
     * Devuelve el número de productos en el carrito del usuario autenticado (AJAX)
     */
    public function cartCount(Request $request)
    {
        $cart = \App\Models\Cart::where('user_id', \Auth::id())->where('status', 'active')->first();
        $count = $cart ? $cart->items()->count() : 0;
        return response()->json(['count' => $count]);
    }

    public function index(): View
    {
        $cart = Cart::firstOrCreate(
            ['user_id' => Auth::id(), 'status' => 'active'],
            ['total' => 0]
        );
        
        return view('cart.index', compact('cart'));
    }

    public function addItem(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'product_id' => 'required|exists:products,id',
            'quantity' => 'required|integer|min:1'
        ]);

        $product = Product::findOrFail($validated['product_id']);

        if ($product->stock < $validated['quantity']) {
            return back()->with('error', 'No hay suficiente stock disponible.');
        }

        $cart = Cart::firstOrCreate(
            ['user_id' => Auth::id(), 'status' => 'active'],
            ['total' => 0]
        );

        $cartItem = $cart->items()->where('product_id', $product->id)->first();

        if ($cartItem) {
            $newQuantity = $cartItem->quantity + $validated['quantity'];
            if ($newQuantity > $product->stock) {
                return back()->with('error', 'No hay suficiente stock disponible.');
            }
            $cartItem->update(['quantity' => $newQuantity]);
        } else {
            $cart->items()->create([
                'product_id' => $product->id,
                'quantity' => $validated['quantity'],
                'price' => $product->price
            ]);
        }

        // Si la petición es AJAX, responder con JSON
        if ($request->expectsJson() || $request->ajax() || $request->wantsJson()) {
            $count = $cart->items()->count();
            return response()->json([
                'success' => true,
                'message' => 'Producto agregado al carrito exitosamente.',
                'count' => $count
            ]);
        }
        // Si NO es AJAX, redirigir como antes
        return redirect()->route('cart.index')
            ->with('success', 'Producto agregado al carrito exitosamente.');
    }

    public function updateItem(Request $request, $itemId): RedirectResponse
    {
        $validated = $request->validate([
            'quantity' => 'required|integer|min:1'
        ]);

        $cart = Cart::where('user_id', Auth::id())
            ->where('status', 'active')
            ->firstOrFail();

        $cartItem = $cart->items()->findOrFail($itemId);
        
        if ($cartItem->product->stock < $validated['quantity']) {
            return back()->with('error', 'No hay suficiente stock disponible.');
        }

        $cartItem->update(['quantity' => $validated['quantity']]);

        return back()->with('success', 'Carrito actualizado exitosamente.');
    }

    public function removeItem($itemId): RedirectResponse
    {
        $cart = Cart::where('user_id', Auth::id())
            ->where('status', 'active')
            ->firstOrFail();

        $cart->items()->findOrFail($itemId)->delete();

        return back()->with('success', 'Producto eliminado del carrito exitosamente.');
    }

    public function clear(): RedirectResponse
    {
        $cart = Cart::where('user_id', Auth::id())
            ->where('status', 'active')
            ->firstOrFail();

        $cart->items()->delete();
        $cart->updateTotal();

        return redirect()->route('cart.index')
            ->with('success', 'Carrito vaciado exitosamente.');
    }
}