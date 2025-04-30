<x-app-layout>
    <x-slot name="header">
        <h2 class="checkout-pending__header">
            {{ __('Pago Pendiente') }}
        </h2>
    </x-slot>

    <div class="checkout-pending__section">
        <div class="checkout-pending__container">
            <div class="checkout-pending__card">
                <div class="checkout-pending__center">
                    <div class="checkout-pending__icon-container">
                        <svg class="checkout-pending__icon" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                    <h3 class="checkout-pending__subtitle">
                        Tu pago está en proceso
                    </h3>
                    <p class="checkout-pending__desc">
                        La orden #{{ $order->id }} está pendiente de confirmación.
                    </p>
                    <div class="checkout-pending__divider">
                        <dl class="checkout-pending__summary-list">
                            <div class="checkout-pending__summary-row">
                                <dt class="checkout-pending__summary-label">Número de Orden</dt>
                                <dd class="checkout-pending__summary-value">#{{ $order->id }}</dd>
                            </div>
                            <div class="checkout-pending__summary-row">
                                <dt class="checkout-pending__summary-label">Total</dt>
                                <dd class="checkout-pending__summary-value">
                                    ${{ number_format($order->total_amount, 2) }}</dd>
                            </div>
                        </dl>
                        <div class="checkout-pending__help-container">
                            <p class="checkout-pending__help">
                                Recibirás un correo electrónico cuando confirmemos tu pago.
                                Este proceso puede tomar hasta 24 horas.
                            </p>
                        </div>
                    </div>
                    <div class="checkout-pending__actions">
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
