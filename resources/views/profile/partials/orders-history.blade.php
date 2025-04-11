<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900">
            {{ __('Historial de Pedidos') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600">
            {{ __('Aquí puedes ver todos tus pedidos realizados y su estado actual.') }}
        </p>
    </header>

    <div class="mt-6 space-y-6">
        <!-- Pedidos Pendientes -->
        <div class="bg-white overflow-hidden shadow-sm rounded-lg">
            <div class="p-4 border-b border-gray-200">
                <h3 class="text-lg font-medium text-gray-900">{{ __('Pedidos Pendientes') }}</h3>
            </div>
            <div class="p-4">
                @if($pendingOrders->isEmpty())
                    <p class="text-gray-600 text-sm">{{ __('No tienes pedidos pendientes.') }}</p>
                @else
                    <div class="space-y-4">
                        @foreach($pendingOrders as $order)
                            <div class="border rounded-lg p-4">
                                <div class="flex justify-between items-start">
                                    <div>
                                        <p class="font-medium">#{{ $order->id }}</p>
                                        <p class="text-sm text-gray-600">{{ $order->created_at->format('d/m/Y H:i') }}</p>
                                    </div>
                                    <span class="px-2 py-1 text-sm font-semibold rounded-full
                                        @if($order->status === 'pending') bg-yellow-100 text-yellow-800
                                        @elseif($order->status === 'processing') bg-blue-100 text-blue-800
                                        @endif">
                                        {{ __($order->status) }}
                                    </span>
                                </div>
                                <div class="mt-2">
                                    <p class="text-sm text-gray-600">Total: ${{ number_format($order->total, 2) }}</p>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @endif
            </div>
        </div>

        <!-- Historial de Pedidos Completados -->
        <div class="bg-white overflow-hidden shadow-sm rounded-lg">
            <div class="p-4 border-b border-gray-200">
                <h3 class="text-lg font-medium text-gray-900">{{ __('Historial de Pedidos') }}</h3>
            </div>
            <div class="p-4">
                @if($completedOrders->isEmpty())
                    <p class="text-gray-600 text-sm">{{ __('No tienes pedidos completados.') }}</p>
                @else
                    <div class="space-y-4">
                        @foreach($completedOrders as $order)
                            <div class="border rounded-lg p-4">
                                <div class="flex justify-between items-start">
                                    <div>
                                        <p class="font-medium">#{{ $order->id }}</p>
                                        <p class="text-sm text-gray-600">{{ $order->created_at->format('d/m/Y H:i') }}</p>
                                    </div>
                                    <span class="px-2 py-1 text-sm font-semibold bg-green-100 text-green-800 rounded-full">
                                        {{ __('completed') }}
                                    </span>
                                </div>
                                <div class="mt-2">
                                    <p class="text-sm text-gray-600">Total: ${{ number_format($order->total, 2) }}</p>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @endif
            </div>
        </div>
    </div>
</section>