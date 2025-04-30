<x-app-layout>
    <x-slot name="header">
        <h2 class="checkout-success__header">
            {{ __('¡Pago Exitoso!') }}
        </h2>
    </x-slot>

    <div class="checkout-success__section">
        <div class="checkout-success__container">
            <div class="checkout-success__card">
                <div class="checkout-success__center">
                    <div class="mb-4">
                        <svg class="checkout-success__icon" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7">
                            </path>
                        </svg>
                    </div>
                    <h3 class="checkout-success__subtitle">
                        ¡Gracias por tu compra!
                    </h3>
                    <p class="checkout-success__desc">
                        Tu orden #{{ $order->id }} ha sido procesada exitosamente.
                    </p>
                    <!-- Resumen del pedido -->
                    <div class="checkout-success__summary">
                        <dl class="checkout-success__summary-list">
                            <div class="checkout-success__summary-row">
                                <dt class="checkout-success__summary-label">Número de Orden</dt>
                                <dd class="checkout-success__summary-value">#{{ $order->id }}</dd>
                            </div>
                            
                            <!-- Desglose del total -->
                            <div class="checkout-success__summary-total-row">
                                <dt class="checkout-success__summary-total-label">Desglose del Total</dt>
                                <dd class="checkout-success__summary-value">
                                    <div class="checkout-success__totals">
                                        <div class="checkout-success__totals-row">
                                            <span class="checkout-success__summary-total-desc">Subtotal:</span>
                                            <span>${{ number_format($order->total / 1.19, 2) }}</span>
                                        </div>
                                        <div class="checkout-success__totals-row">
                                            <span class="checkout-success__summary-total-desc">IVA (19%):</span>
                                            <span>${{ number_format($order->total - ($order->total / 1.19), 2) }}</span>
                                        </div>
                                        <div class="checkout-success__totals-row checkout-success__totals-row--total">
                                            <span class="checkout-success__totals-label">Total:</span>
                                            <span class="checkout-success__totals-label">${{ number_format($order->total, 2) }}</span>
                                        </div>
                                    </div>
                                </dd>
                            </div>

                            <div class="checkout-success__summary-row">
                                <dt class="checkout-success__summary-label">Dirección de Envío</dt>
                                <dd class="checkout-success__summary-value">
                                    {{ $order->shipping_address }}<br>
                                    {{ $order->shipping_city }}, {{ $order->shipping_state }}<br>
                                    CP: {{ $order->shipping_postal_code }}
                                </dd>
                            </div>
                        </dl>
                    </div>
                    <div class="checkout-success__actions">
                        <a href="{{ route('orders.index') }}"
                            class="primary-btn">
                            Ver Mis Pedidos
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
