<x-app-layout>
    <x-slot name="header">
        <div class="orders-show__header-bar">
            <h2 class="orders-show__header">
                {{ __('Detalles del Pedido #') . $order->id }}
            </h2>
            <a href="{{ route('orders.history') }}"
                class="orders-show__btn">
                Volver a Mis Pedidos
            </a>
        </div>
    </x-slot>

    <div class="orders-show__section">
        <div class="orders-show__container">
            <div class="orders-show__card">
                <div class="orders-show__content">
                    <!-- Mensajes de feedback de pago -->
                    @if (session('success'))
                        <div class="orders-show__alert orders-show__alert--success">
                            <strong>¡Éxito!</strong> {{ session('success') }}
                        </div>
                    @endif
                    @if (session('error'))
                        <div class="orders-show__alert orders-show__alert--error">
                            <strong>Error:</strong> {{ session('error') }}
                        </div>
                    @endif
                    <!-- Estado del Pedido -->
                    <div class="orders-show__section orders-show__section--status">
                        <div class="orders-show__status-bar">
                            <div>
                                <p class="orders-show__status-label">Estado del pedido</p>
                                <span class="orders-show__status orders-show__status--{{ $order->status }}">
                                    {{ ucfirst($order->status) }}
                                </span>
                            </div>
                            <div class="orders-show__status-date">
                                <p class="orders-show__status-date-label">Fecha del pedido</p>
                                <p class="orders-show__status-date-value">
                                    {{ $order->created_at->format('d/m/Y H:i') }}</p>
                            </div>
                        </div>
                    </div>

                    <div class="orders-show__main-grid">
                        <!-- Comprobante de Pago -->
                        @if($order->payment_proof)
                        <div class="orders-show__info-card">
                            <h3 class="orders-show__subtitle">Comprobante de Pago</h3>
                            <img src="{{ asset('storage/' . $order->payment_proof) }}" alt="Comprobante de pago" class="orders-show__proof-img">
                            <a href="{{ asset('storage/' . $order->payment_proof) }}" target="_blank" class="orders-show__proof-link">Ver tamaño completo</a>
                        </div>
                        @endif
                        <!-- Información de Envío -->
                        <div class="orders-show__info-card">
                            <h3 class="orders-show__subtitle">Información de Envío</h3>
                            <dl class="orders-show__info-grid">
                                <div>
                                    <dt class="orders-show__shipping-label">Nombre</dt>
                                    <dd class="orders-show__shipping-value">{{ $order->name }}</dd>
                                </div>
                                <div>
                                    <dt class="orders-show__shipping-label">Email</dt>
                                    <dd class="orders-show__shipping-value">{{ $order->email }}</dd>
                                </div>
                                <div>
                                    <dt class="orders-show__shipping-label">Teléfono</dt>
                                    <dd class="orders-show__shipping-value">{{ $order->phone }}</dd>
                                </div>
                                <div>
                                    <dt class="orders-show__shipping-label">Dirección</dt>
                                    <dd class="orders-show__shipping-value">{{ $order->shipping_address }}</dd>
                                </div>
                                <div>
                                    <dt class="orders-show__shipping-label">Ciudad</dt>
                                    <dd class="orders-show__shipping-value">{{ $order->shipping_city }}</dd>
                                </div>
                                <div>
                                    <dt class="orders-show__shipping-label">Código Postal</dt>
                                    <dd class="orders-show__shipping-value">{{ $order->shipping_zip }}</dd>
                                </div>
                            </dl>
                        </div>

                        <!-- Información del Pago -->
                        <div class="orders-show__info-card">
                            <h3 class="orders-show__subtitle">Información del Pago</h3>
                            <dl class="orders-show__info-grid">
                                <div>
                                    <dt class="orders-show__shipping-label">Método de Pago</dt>
                                    <dd class="orders-show__shipping-value">{{ ucfirst($order->payment_method) }}</dd>
                                </div>
                                <div>
                                    <dt class="orders-show__shipping-label">Estado del Pago</dt>
                                    <dd class="orders-show__info-separator">
                                        <span
                                            class="orders-show__payment-status">
                                            Pagado
                                        </span>
                                    </dd>
                                </div>
                                <div>
                                    <dt class="orders-show__shipping-label">Total</dt>
                                    <dd class="mt-1 text-lg font-medium text-gray-900">
                                        ${{ number_format($order->total, 2) }}</dd>
                                </div>
                            </dl>
                        </div>
                    </div>

                    <!-- Productos del Pedido -->
                    <div class="orders-show__products-section">
                        <h3 class="orders-show__subtitle">Productos del Pedido</h3>
                        <div class="orders-show__products-card">
                            <div class="orders-show__products-list">
                                <ul role="list" class="orders-show__products-list-items">
                                    @foreach ($order->items as $item)
                                        <li class="p-6">
                                            <div class="flex items-center">
                                                <div
                                                    class="flex-shrink-0 w-24 h-24 border border-gray-200 rounded-md overflow-hidden">
                                                    @if ($item->product->images->isNotEmpty())
                                                        <img src="{{ asset('storage/' . $item->product->images->first()->path) }}"
                                                            alt="{{ $item->product->name }}"
                                                            class="w-full h-full object-center object-cover">
                                                    @else
                                                        <div
                                                            class="w-full h-full bg-gray-200 flex items-center justify-center">
                                                            <span class="text-gray-500 text-xs">Sin imagen</span>
                                                        </div>
                                                    @endif
                                                </div>

                                                <div class="ml-6 flex-1">
                                                    <div class="flex items-center justify-between">
                                                        <div>
                                                            <h4 class="text-sm font-medium text-gray-900">
                                                                {{ $item->product->name }}</h4>
                                                            <p class="mt-1 text-sm text-gray-500">Cantidad:
                                                                {{ $item->quantity }}</p>
                                                        </div>
                                                        <div class="ml-4">
                                                            <p class="text-sm font-medium text-gray-900">
                                                                ${{ number_format($item->price, 2) }} c/u</p>
                                                            <p class="mt-1 text-sm text-gray-500">Subtotal:
                                                                ${{ number_format($item->subtotal, 2) }}</p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                            <div class="border-t border-gray-200 px-6 py-4">
                                <div class="flex justify-between text-base font-medium text-gray-900">
                                    <p>Total</p>
                                    <p>${{ number_format($order->total, 2) }}</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    @if ($order->status === 'pending' || $order->status === 'processing')
                        <div class="mt-8 text-center">
                            <p class="text-sm text-gray-500">¿Tienes alguna pregunta sobre tu pedido?</p>
                            <a href="#"
                                class="mt-2 inline-flex items-center text-sm font-medium text-blue-600 hover:text-blue-500">
                                Contactar con soporte
                                <span aria-hidden="true"> &rarr;</span>
                            </a>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
