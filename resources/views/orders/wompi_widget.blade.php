<x-app-layout>
    <x-slot name="header">
        <h2 class="orders-wompi-widget__header">
            {{ __('Completa tu pago con Wompi') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-lg sm:rounded-lg">
                <div class="orders-wompi-widget__main">
                    <h3 class="orders-wompi-widget__title">Pedido #{{ $order->id }}</h3>
                    <div class="orders-wompi-widget__summary">
                        <div class="flex flex-col sm:flex-row sm:justify-between mb-2">
                            <span class="orders-wompi-widget__summary-label">Referencia de pago:</span>
                            <span>{{ $order->order_number ?? '-' }}</span>
                        </div>
                        <div class="flex flex-col sm:flex-row sm:justify-between mb-2">
                            <span class="orders-wompi-widget__summary-label">Estado:</span>
                            <span class="capitalize">{{ $order->status }}</span>
                        </div>
                        <div class="flex flex-col sm:flex-row sm:justify-between">
                            <span class="orders-wompi-widget__summary-label">Total a pagar:</span>
                            <span class="orders-wompi-widget__summary-value orders-wompi-widget__summary-value--total">${{ number_format($order->total, 2) }}</span>
                        </div>
                    </div>

                    <!-- Wompi Widget -->
                    <div id="wompi-widget"></div>

                    <script src="https://checkout.wompi.co/widget.js"></script>
                    <script>
                        new WidgetCheckout({
                            currency: 'COP',
                            amountInCents: {{ intval($order->total * 100) }},
                            reference: '{{ $order->id }}',
                            publicKey: '{{ config('services.wompi.public_key') }}',
                            redirectUrl: '{{ route('wompi.callback', $order) }}',
                            signature: '', // Opcional: si tienes firma de seguridad
                            // customerData: {}, // Puedes agregar datos del cliente aquí
                        });
                    </script>

                    <div class="orders-wompi-widget__actions">
                        <a href="{{ route('orders.show', $order) }}" class="orders-wompi-widget__btn orders-wompi-widget__btn--primary">Ver detalles del pedido</a>
                        <a href="{{ route('shop.index') }}" class="orders-wompi-widget__btn orders-wompi-widget__btn--secondary">Volver a la tienda</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
