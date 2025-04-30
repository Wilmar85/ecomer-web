<x-app-layout>
    <x-slot name="header">
        <h2 class="orders-history__header">
            {{ __('Mis Pedidos') }}
        </h2>
    </x-slot>

    <div class="orders-history__section">
        <div class="orders-history__container">
            <div class="orders-history__card">
                <div class="orders-history__content">
                    @if ($orders->isEmpty())
                        <div class="orders-history__empty">
                            <svg class="orders-history__icon" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                            </svg>
                            <h3 class="orders-history__empty-title">No hay pedidos</h3>
                            <p class="orders-history__empty-text">Aún no has realizado ningún pedido.</p>
                            <div class="orders-history__empty-btn-container">
                                <a href="{{ route('products.index') }}"
                                    class="orders-history__btn">
                                    <svg class="orders-history__btn-icon" xmlns="http://www.w3.org/2000/svg"
                                        viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd"
                                            d="M10 3a1 1 0 00-1 1v5H4a1 1 0 100 2h5v5a1 1 0 102 0v-5h5a1 1 0 100-2h-5V4a1 1 0 00-1-1z"
                                            clip-rule="evenodd" />
                                    </svg>
                                    Comenzar a comprar
                                </a>
                            </div>
                        </div>
                    @else
                        <div class="orders-history__list">
                            @foreach ($orders as $order)
                                <div class="orders-history__order">
                                    <div class="orders-history__order-header">
                                        <div class="orders-history__order-titlebar">
                                            <div>
                                                <h3 class="orders-history__order-title">Pedido
                                                    #{{ $order->id }}</h3>
                                                <p class="orders-history__order-date">Realizado el
                                                    {{ $order->created_at->format('d/m/Y H:i') }}</p>
                                            </div>
                                            <span class="orders-history__order-status orders-history__order-status--{{ $order->status }}">
                                                {{ ucfirst($order->status) }}
                                            </span>
                                        </div>

                                        <div class="orders-history__order-body">
                                            <div class="orders-history__order-items">
                                                <ul class="orders-history__order-items-list">
                                                    @foreach ($order->items as $item)
                                                        <li class="orders-history__order-item">
                                                            <div class="orders-history__order-item-img-container">
                                                                @if ($item->product->images->isNotEmpty())
                                                                    <img src="{{ asset('storage/' . $item->product->images->first()->path) }}" alt="{{ $item->product->name }}" class="orders-history__order-item-img">
                                                                @else
                                                                    <div class="orders-history__order-item-img--placeholder">
                                                                        <span class="orders-history__order-item-img--placeholder-text">Sin imagen</span>
                                                                    </div>
                                                                @endif
                                                            </div>

                                                            <div class="orders-history__order-item-info">
                                                                <div class="orders-history__order-item-titlebar">
                                                                    <h4>{{ $item->product->name }}</h4>
                                                                    <p class="orders-history__order-item-subtotal">${{ number_format($item->subtotal, 2) }}</p>
                                                                        {{ $item->quantity }}</p>
                                                                </div>
                                                            </div>
                                                        </li>
                                                    @endforeach
                                                </ul>
                                            </div>
                                        </div>

                                        <div class="orders-history__order-summary">
                                            <div class="orders-history__order-summary-row">
                                                <p>Total</p>
                                                <p>${{ number_format($order->total, 2) }}</p>
                                            </div>
                                            <div class="mt-4">
                                                <a href="{{ route('orders.show', $order) }}"
                                                    class="orders-history__order-details-link">
                                                    Ver detalles del pedido
                                                    <span aria-hidden="true"> &rarr;</span>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach

                            <div class="orders-history__pagination">
                                {{ $orders->links() }}
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
