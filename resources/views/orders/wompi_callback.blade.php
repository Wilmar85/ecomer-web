<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Estado del Pago - Wompi') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h3 class="text-lg font-medium mb-4">Pedido #{{ $order->id }}</h3>

                    @if(session('success'))
                        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4">
                            {{ session('success') }}
                        </div>
                    @endif
                    @if(session('error'))
                        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4">
                            {{ session('error') }}
                        </div>
                    @endif

                    <div class="mb-4">
                        <p><strong>Estado del pedido:</strong> <span class="font-bold">{{ $order->status }}</span></p>
                        <p><strong>Total:</strong> ${{ number_format($order->total, 2) }}</p>
                    </div>

                    <a href="{{ route('orders.show', $order) }}" class="text-blue-500 hover:text-blue-700">Ver detalles del pedido</a>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
