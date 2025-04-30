<section>
    <header>
        <h2 class="bem-base__title">
            {{ __('Historial de Pedidos') }}
        </h2>

        <p class="input-error">
            {{ __('Aquí puedes ver todos tus pedidos realizados y su estado actual.') }}
        </p>
    </header>

    <div class="bem-base__section">
        <!-- Pedidos Pendientes -->
        <div class="bem-base__card">
            <div class="bem-base__card-header">
                <h3 class="bem-base__title">{{ __('Pedidos Pendientes') }}</h3>
            </div>
            <div class="bem-base__card-body">
                @if($pendingOrders->isEmpty())
                    <p class="input-error">{{ __('No tienes pedidos pendientes.') }}</p>
                @else
                    <div class="bem-base__spacer">
                        @foreach($pendingOrders as $order)
                            <div class="bem-base__card-inner">
                                <div class="bem-base__card-row">
                                    <div>
                                        <p class="orders-history__order-id">#{{ $order->id }}</p>
                                        <p class="input-error">{{ $order->created_at->format('d/m/Y H:i') }}</p>
                                    </div>
                                    <span class="bem-base__badge"
                                        @if($order->status === 'pending') bg-yellow-100 text-yellow-800
                                        @elseif($order->status === 'processing') bg-blue-100 text-blue-800
                                        @endif">
                                        {{ __($order->status) }}
                                    </span>
                                </div>
                                <div class="bem-base__mt">
                                    <p class="input-error">Total: ${{ number_format($order->total, 2) }}</p>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @endif
            </div>
        </div>

        <!-- Historial de Pedidos Completados -->
        <div class="bem-base__card">
            <div class="bem-base__card-header">
                <h3 class="bem-base__title">{{ __('Historial de Pedidos') }}</h3>
            </div>
            <div class="bem-base__card-body">
                @if($completedOrders->isEmpty())
                    <p class="input-error">{{ __('No tienes pedidos completados.') }}</p>
                @else
                    <div class="bem-base__spacer">
                        @foreach($completedOrders as $order)
                            <div class="bem-base__card-inner">
                                <div class="bem-base__card-row">
                                    <div>
                                        <p class="orders-history__order-id">#{{ $order->id }}</p>
                                        <p class="input-error">{{ $order->created_at->format('d/m/Y H:i') }}</p>
                                    </div>
                                    <span class="bem-base__badge">
                                        {{ __('completed') }}
                                    </span>
                                </div>
                                <div class="bem-base__mt">
                                    <p class="input-error">Total: ${{ number_format($order->total, 2) }}</p>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @endif
            </div>
        </div>
    </div>
</section>