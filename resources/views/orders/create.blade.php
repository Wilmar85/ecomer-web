<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Finalizar Compra') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    @if ($errors->any())
                        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4"
                            role="alert">
                            <ul class="list-disc list-inside">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{ route('orders.store') }}" method="POST" class="space-y-8">
                        @csrf

                        <!-- Resumen del pedido -->
                        <div class="bg-gray-50 p-6 rounded-lg mb-6">
                            <h3 class="text-lg font-medium text-gray-900 mb-4">Resumen del Pedido</h3>
                            <div class="space-y-4">
                                @foreach ($cart->items as $item)
                                    <div class="flex justify-between items-center">
                                        <div class="flex items-center space-x-4">
                                            @if ($item->product->images->isNotEmpty())
                                                <img src="{{ asset('storage/' . $item->product->images->first()->path) }}"
                                                    alt="{{ $item->product->name }}"
                                                    class="w-16 h-16 object-cover rounded">
                                            @else
                                                <div
                                                    class="w-16 h-16 bg-gray-200 rounded flex items-center justify-center">
                                                    <span class="text-gray-500 text-xs">Sin imagen</span>
                                                </div>
                                            @endif
                                            <div>
                                                <h4 class="text-sm font-medium text-gray-900">{{ $item->product->name }}
                                                </h4>
                                                <p class="text-sm text-gray-500">Cantidad: {{ $item->quantity }}</p>
                                            </div>
                                        </div>
                                        <p class="text-sm font-medium text-gray-900">
                                            ${{ number_format($item->subtotal, 2) }}</p>
                                    </div>
                                @endforeach

                                <div class="border-t border-gray-200 pt-4">
                                    <div class="flex justify-between text-base font-medium text-gray-900">
                                        <p>Total</p>
                                        <p>${{ number_format($cart->total, 2) }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Método de entrega -->
                        <div class="space-y-6">
                            <h3 class="text-lg font-medium text-gray-900">Método de Entrega</h3>
                            <div class="space-y-4">
                                <div class="flex items-center">
                                    <input type="radio" name="delivery_method" id="delivery" value="delivery"
                                        class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300" checked
                                        onchange="toggleAddressFields()">
                                    <label for="delivery" class="ml-3 block text-sm font-medium text-gray-700">
                                        Envío a domicilio
                                    </label>
                                </div>

                                <div class="flex items-center">
                                    <input type="radio" name="delivery_method" id="pickup" value="pickup"
                                        class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300"
                                        onchange="toggleAddressFields()">
                                    <label for="pickup" class="ml-3 block text-sm font-medium text-gray-700">
                                        Recoger en tienda
                                    </label>
                                </div>
                            </div>
                        </div>

                        <!-- Información de envío -->
                        <div class="space-y-6" id="shipping-info">
                            <h3 class="text-lg font-medium text-gray-900">Información de Envío</h3>

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div>
                                    <label for="name" class="block text-sm font-medium text-gray-700">Nombre
                                        completo</label>
                                    <input type="text" name="name" id="name"
                                        value="{{ old('name', auth()->user()->name) }}"
                                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500"
                                        required>
                                </div>

                                <div>
                                    <label for="email" class="block text-sm font-medium text-gray-700">Correo
                                        electrónico</label>
                                    <input type="email" name="email" id="email"
                                        value="{{ old('email', auth()->user()->email) }}"
                                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500"
                                        required>
                                </div>

                                <div>
                                    <label for="phone"
                                        class="block text-sm font-medium text-gray-700">Teléfono</label>
                                    <input type="tel" name="phone" id="phone" value="{{ old('phone') }}"
                                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500"
                                        required>
                                </div>

                                <div class="address-field">
                                    <label for="address" class="block text-sm font-medium text-gray-700">Dirección</label>
                                    <input type="text" name="address" id="address" value="{{ old('address') }}"
                                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                                </div>

                                <div class="address-field">
                                    <label for="city" class="block text-sm font-medium text-gray-700">Ciudad</label>
                                    <input type="text" name="city" id="city" value="{{ old('city') }}"
                                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                                </div>

                                <div class="address-field">
                                    <label for="state" class="block text-sm font-medium text-gray-700">Estado</label>
                                    <input type="text" name="state" id="state" value="{{ old('state') }}"
                                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                                </div>
                            </div>
                        </div>

                        <script>
                        function toggleAddressFields() {
                            const addressFields = document.querySelectorAll('.address-field');
                            const isDelivery = document.getElementById('delivery').checked;
                            
                            addressFields.forEach(field => {
                                const input = field.querySelector('input');
                                field.style.display = isDelivery ? 'block' : 'none';
                                input.required = isDelivery;
                            });
                        }

                        // Ejecutar al cargar la página
                        document.addEventListener('DOMContentLoaded', toggleAddressFields);
                        </script>
                        <!-- Método de pago -->
                        <div class="space-y-6">
                            <h3 class="text-lg font-medium text-gray-900">Método de Pago</h3>

                            <div class="space-y-4">
                                <div class="flex items-center">
                                    <input type="radio" name="payment_method" id="card" value="card"
                                        class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300" checked>
                                    <label for="card" class="ml-3 block text-sm font-medium text-gray-700">
                                        Tarjeta de crédito/débito
                                    </label>
                                </div>

                                <div class="flex items-center">
                                    <input type="radio" name="payment_method" id="cash" value="cash"
                                        class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300">
                                    <label for="cash" class="ml-3 block text-sm font-medium text-gray-700">
                                        Pago en efectivo
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="flex justify-between items-center pt-6 border-t border-gray-200">
                            <a href="{{ route('cart.index') }}" class="text-blue-500 hover:text-blue-700">
                                Volver al carrito
                            </a>

                            <button type="submit"
                                class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                                Confirmar Pedido
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
