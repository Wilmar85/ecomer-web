<x-app-layout>
    <x-slot name="header">
        <h2 class="cart-index__header">
            {{ __('Carrito de Compras') }}
        </h2>
    </x-slot>

    <div class="cart-index__section">
        <div class="cart-index__container">
            <div class="cart-index__card">
                <div class="cart-index__body">
                    @if (session('success'))
                        <div class="cart-index__alert--success"
                            role="alert">
                            <span class="cart-index__alert-txt">{{ session('success') }}</span>
                        </div>
                    @endif

                    @if (session('error'))
                        <div class="cart-index__alert--error"
                            role="alert">
                            <span class="cart-index__alert-txt">{{ session('error') }}</span>
                        </div>
                    @endif

                    @if ($cart->items->isEmpty())
                        <div class="cart-index__empty">
                            <p class="cart-index__empty-msg">Tu carrito está vacío</p>
                            <a href="{{ route('products.index') }}" class="cart-index__btn">
                                Continuar comprando
                            </a>
                        </div>
                    @else
                        <div class="cart-index__scroll">
                            <table class="cart-index__table">
                                <thead class="cart-index__thead">
                                    <tr>
                                        <th
                                            class="cart-index__th">
                                            Producto</th>
                                        <th
                                            class="cart-index__th">
                                            Precio</th>
                                        <th
                                            class="cart-index__th">
                                            Cantidad</th>
                                        <th
                                            class="cart-index__th">
                                            Subtotal</th>
                                        <th
                                            class="cart-index__th">
                                            Acciones</th>
                                    </tr>
                                </thead>
                                <tbody class="cart-index__tbody">
                                    @foreach ($cart->items as $item)
                                        <tr>
                                            <td class="cart-index__td">
                                                <div class="cart-index__item">
                                                    @if ($item->product->images->isNotEmpty())
                                                        <img src="{{ asset('storage/' . $item->product->images->first()->path) }}"
                                                            alt="{{ $item->product->name }}"
                                                            class="cart-index__img">
                                                    @else
                                                        <div
                                                            class="cart-index__img-placeholder">
                                                            <span class="cart-index__img-placeholder-txt">Sin imagen</span>
                                                        </div>
                                                    @endif
                                                    <div class="cart-index__item-info">
                                                        <a href="{{ route('products.show', $item->product) }}"
                                                            class="cart-index__item-link">
                                                            {{ $item->product->name }}
                                                        </a>
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="cart-index__td--muted">
                                                ${{ number_format($item->price, 2) }}
                                            </td>
                                            <td class="cart-index__td">
                                                <form action="{{ route('cart.update', $item->id) }}" method="POST"
                                                    class="cart-index__qty-form">
                                                    @csrf
                                                    @method('PATCH')
                                                    <input type="number" name="quantity" value="{{ $item->quantity }}"
                                                        min="1" max="{{ $item->product->stock }}"
                                                        class="cart-index__qty-input">
                                                    <button type="submit" class="cart-index__qty-btn">
                                                        Actualizar
                                                    </button>
                                                </form>
                                            </td>
                                            <td class="cart-index__td--muted">
                                                ${{ number_format($item->subtotal, 2) }}
                                            </td>
                                            <td class="cart-index__td--actions">
                                                <form action="{{ route('cart.remove', $item->id) }}" method="POST"
                                                    class="cart-index__form-inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="cart-index__remove-btn">
                                                        Eliminar
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <td colspan="3" class="cart-index__total-label">Total:</td>
                                        <td class="cart-index__total-value">
                                            ${{ number_format($cart->total, 2) }}</td>
                                        <td></td>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>

                        <div class="cart-index__actions">
                            <form action="{{ route('cart.clear') }}" method="POST">
                                @csrf
                                <button type="submit"
                                    class="danger-btn">
                                    Vaciar carrito
                                </button>
                            </form>

                            <a href="{{ route('checkout.index') }}"
                                class="primary-btn">
                                Proceder al pago
                            </a>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
