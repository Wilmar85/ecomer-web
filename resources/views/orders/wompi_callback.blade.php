<x-app-layout>
    <x-slot name="header">
        <h2 class="orders-wompi-callback__header">
            {{ __('Estado del Pago - Wompi') }}
        </h2>
    </x-slot>

    <div class="orders-wompi-callback__section">
        <div class="orders-wompi-callback__container">
            <div class="orders-wompi-callback__card">
                <div class="orders-wompi-callback__main">
                    @php
                        $status = $order->status;
                        $statusColor = [
                            'processing' => 'green',
                            'completed' => 'green',
                            'paid' => 'green',
                            'pending' => 'yellow',
                            'pending_pickup' => 'yellow',
                            'failed' => 'red',
                            'cancelled' => 'red',
                        ][$status] ?? 'yellow';
                        $icon = [
                            'green' => '<svg class="orders-wompi-callback__icon orders-wompi-callback__icon--success" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><circle cx="12" cy="12" r="10" stroke="currentColor" stroke-width="2" fill="none"/><path stroke-linecap="round" stroke-linejoin="round" d="M8 12l2.5 2.5L16 9"/></svg>',
                            'yellow' => '<svg class="orders-wompi-callback__icon orders-wompi-callback__icon--pending" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><circle cx="12" cy="12" r="10" stroke="currentColor" stroke-width="2" fill="none"/><path stroke-linecap="round" stroke-linejoin="round" d="M12 8v4m0 4h.01"/></svg>',
                            'red' => '<svg class="orders-wompi-callback__icon orders-wompi-callback__icon--error" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><circle cx="12" cy="12" r="10" stroke="currentColor" stroke-width="2" fill="none"/><path stroke-linecap="round" stroke-linejoin="round" d="M15 9l-6 6m0-6l6 6"/></svg>',
                        ][$statusColor];
                        $mainMsg = [
                            'green' => '¡Pago exitoso!',
                            'yellow' => 'Pago pendiente de confirmación',
                            'red' => 'Pago fallido o cancelado',
                        ][$statusColor];
                        $descMsg = [
                            'green' => 'Tu pedido ha sido procesado correctamente. Recibirás confirmación en tu correo.',
                            'yellow' => 'Estamos procesando tu pago. Te notificaremos cuando se confirme.',
                            'red' => 'El pago no se completó. Si crees que es un error, comunícate con soporte.',
                        ][$statusColor];
                    @endphp

                    {!! $icon !!}
                    <h3 class="orders-wompi-callback__status orders-wompi-callback__status--{{ $statusColor }}">{{ $mainMsg }}</h3>
                    <p class="orders-wompi-callback__desc">{{ $descMsg }}</p>

                    <div class="orders-wompi-callback__summary">
                        <div class="orders-wompi-callback__summary-row orders-wompi-callback__summary-row--mb">
                            <span class="orders-wompi-callback__summary-label">Pedido:</span>
                            <span>#{{ $order->id }}</span>
                        </div>
                        <div class="orders-wompi-callback__summary-row orders-wompi-callback__summary-row--mb">
                            <span class="orders-wompi-callback__summary-label">Referencia de pago:</span>
                            <span>{{ $order->order_number ?? '-' }}</span>
                        </div>
                        <div class="orders-wompi-callback__summary-row orders-wompi-callback__summary-row--mb">
                            <span class="orders-wompi-callback__summary-label">Estado:</span>
                            <span class="capitalize">{{ $order->status }}</span>
                        </div>
                        <div class="orders-wompi-callback__summary-row">
                            <span class="orders-wompi-callback__summary-label">Total pagado:</span>
                            <span class="orders-wompi-callback__summary-value orders-wompi-callback__summary-value--total">${{ number_format($order->total, 2) }}</span>
                        </div>
                    </div>

                    <div class="orders-wompi-callback__actions">
                        <a href="{{ route('orders.show', $order) }}" class="orders-wompi-callback__btn orders-wompi-callback__btn--primary">Ver detalles del pedido</a>
                        <a href="{{ route('shop.index') }}" class="orders-wompi-callback__btn orders-wompi-callback__btn--secondary">Volver a la tienda</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
