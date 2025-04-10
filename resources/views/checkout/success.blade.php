<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('¡Pago Exitoso!') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                <div class="text-center">
                    <div class="mb-4">
                        <svg class="mx-auto h-12 w-12 text-green-500" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7">
                            </path>
                        </svg>
                    </div>
                    <h3 class="text-lg leading-6 font-medium text-gray-900 mb-2">
                        ¡Gracias por tu compra!
                    </h3>
                    <p class="text-sm text-gray-500 mb-4">
                        Tu orden #{{ $order->id }} ha sido procesada exitosamente.
                    </p>
                    <div class="border-t border-gray-200 pt-4">
                        <dl class="divide-y divide-gray-200">
                            <div class="py-4 sm:grid sm:grid-cols-3 sm:gap-4">
                                <dt class="text-sm font-medium text-gray-500">Número de Orden</dt>
                                <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">#{{ $order->id }}</dd>
                            </div>
                            <div class="py-4 sm:grid sm:grid-cols-3 sm:gap-4">
                                <dt class="text-sm font-medium text-gray-500">Total</dt>
                                <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                                    ${{ number_format($order->total_amount, 2) }}</dd>
                            </div>
                            <div class="py-4 sm:grid sm:grid-cols-3 sm:gap-4">
                                <dt class="text-sm font-medium text-gray-500">Dirección de Envío</dt>
                                <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                                    {{ $order->shipping_address }}<br>
                                    {{ $order->shipping_city }}, {{ $order->shipping_state }}<br>
                                    CP: {{ $order->shipping_postal_code }}
                                </dd>
                            </div>
                        </dl>
                    </div>
                    <div class="mt-6">
                        <a href="{{ route('orders.index') }}"
                            class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                            Ver Mis Pedidos
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
