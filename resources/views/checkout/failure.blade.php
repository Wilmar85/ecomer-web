<x-app-layout>
    <x-slot name="header">
        <h2 class="checkout-failure__header">
            {{ __('Error en el Pago') }}
        </h2>
    </x-slot>

    <div class="checkout-failure__section">
        <div class="checkout-failure__container">
            <div class="checkout-failure__card">
                <div class="checkout-failure__center">
                    <div class="checkout-failure__icon-container">
                        <svg class="checkout-failure__icon" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                    </div>
                    <h3 class="checkout-failure__subtitle">
                        Lo sentimos, hubo un problema con tu pago
                    </h3>
                    <p class="checkout-failure__desc">
                        Tu orden #{{ $order->id }} no pudo ser procesada.
                    </p>
                    <div class="checkout-failure__divider">
                        <p class="checkout-failure__help">
                            Por favor, intenta realizar el pago nuevamente o contacta con nuestro servicio de atención
                            al cliente si el problema persiste.
                        </p>
                    </div>
                    <div class="checkout-failure__actions">
                        <a href="{{ route('checkout.index') }}"
                            class="primary-btn">
                            Intentar Nuevamente
                        </a>
                        <a href="{{ route('cart.index') }}"
                            class="secondary-btn">
                            Volver al Carrito
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
