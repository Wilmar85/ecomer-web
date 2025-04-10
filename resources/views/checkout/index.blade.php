<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Finalizar Compra') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <!-- Formulario de Envío -->
                <div class="md:col-span-2">
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                        <h3 class="text-lg font-medium text-gray-900 mb-4">Información de Envío</h3>
                        <form id="shipping-form" class="space-y-4">
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <div>
                                    <x-input-label for="name" :value="__('Nombre completo')" />
                                    <x-text-input id="name" name="name" type="text" class="mt-1 block w-full"
                                        :value="old('name', auth()->user()->name)" required autofocus />
                                    <x-input-error class="mt-2" :messages="$errors->get('name')" />
                                </div>

                                <div>
                                    <x-input-label for="email" :value="__('Email')" />
                                    <x-text-input id="email" name="email" type="email" class="mt-1 block w-full"
                                        :value="old('email', auth()->user()->email)" required />
                                    <x-input-error class="mt-2" :messages="$errors->get('email')" />
                                </div>

                                <div>
                                    <x-input-label for="phone" :value="__('Teléfono')" />
                                    <x-text-input id="phone" name="phone" type="tel" class="mt-1 block w-full"
                                        :value="old('phone')" required />
                                    <x-input-error class="mt-2" :messages="$errors->get('phone')" />
                                </div>

                                <div>
                                    <x-input-label for="postal_code" :value="__('Código Postal')" />
                                    <x-text-input id="postal_code" name="postal_code" type="text"
                                        class="mt-1 block w-full" :value="old('postal_code')" required />
                                    <x-input-error class="mt-2" :messages="$errors->get('postal_code')" />
                                </div>

                                <div class="md:col-span-2">
                                    <x-input-label for="address" :value="__('Dirección')" />
                                    <x-text-input id="address" name="address" type="text" class="mt-1 block w-full"
                                        :value="old('address')" required />
                                    <x-input-error class="mt-2" :messages="$errors->get('address')" />
                                </div>

                                <div>
                                    <x-input-label for="city" :value="__('Ciudad')" />
                                    <x-text-input id="city" name="city" type="text" class="mt-1 block w-full"
                                        :value="old('city')" required />
                                    <x-input-error class="mt-2" :messages="$errors->get('city')" />
                                </div>

                                <div>
                                    <x-input-label for="state" :value="__('Estado/Provincia')" />
                                    <x-text-input id="state" name="state" type="text" class="mt-1 block w-full"
                                        :value="old('state')" required />
                                    <x-input-error class="mt-2" :messages="$errors->get('state')" />
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

                <!-- Resumen del Pedido -->
                <div class="md:col-span-1">
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                        <h3 class="text-lg font-medium text-gray-900 mb-4">Resumen del Pedido</h3>
                        <div class="space-y-4">
                            <!-- Lista de Productos -->
                            <div class="divide-y divide-gray-200">
                                @foreach ($cartItems as $item)
                                    <div class="py-4 flex justify-between">
                                        <div class="flex-1">
                                            <h4 class="text-sm font-medium text-gray-900">{{ $item->product->name }}
                                            </h4>
                                            <p class="text-sm text-gray-500">Cantidad: {{ $item->quantity }}</p>
                                        </div>
                                        <div class="text-sm font-medium text-gray-900">
                                            ${{ number_format($item->subtotal, 2) }}
                                        </div>
                                    </div>
                                @endforeach
                            </div>

                            <!-- Totales -->
                            <div class="border-t border-gray-200 pt-4">
                                <div class="flex justify-between text-sm">
                                    <span class="text-gray-600">Subtotal</span>
                                    <span class="text-gray-900">${{ number_format($subtotal, 2) }}</span>
                                </div>
                                <div class="flex justify-between text-sm mt-2">
                                    <span class="text-gray-600">Envío</span>
                                    <span class="text-gray-900">${{ number_format($shipping, 2) }}</span>
                                </div>
                                <div class="flex justify-between text-base font-medium mt-4">
                                    <span class="text-gray-900">Total</span>
                                    <span class="text-gray-900">${{ number_format($total, 2) }}</span>
                                </div>
                            </div>

                            <!-- Botón de MercadoPago -->
                            <div class="mt-6">
                                <div id="wallet_container"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
        <script src="https://sdk.mercadopago.com/js/v2"></script>
        <script>
            const mp = new MercadoPago('{{ config('services.mercadopago.public_key') }}');
            const bricksBuilder = mp.bricks();

            // Validación de stock en tiempo real
            async function validateStock() {
                try {
                    const response = await fetch('/api/cart/validate-stock');
                    const data = await response.json();

                    if (!data.valid) {
                        alert('Algunos productos no tienen suficiente stock disponible.');
                        window.location.href = '/cart';
                        return false;
                    }
                    return true;
                } catch (error) {
                    console.error('Error validando stock:', error);
                    return false;
                }
            }

            // Renderizar botón de pago
            async function renderPaymentButton() {
                const settings = {
                    initialization: {
                        amount: {{ $total }}
                    },
                    callbacks: {
                        onSubmit: async (cardFormData) => {
                            if (!await validateStock()) return;

                            const form = document.getElementById('shipping-form');
                            const formData = new FormData(form);

                            try {
                                const response = await fetch('/checkout/process', {
                                    method: 'POST',
                                    headers: {
                                        'Content-Type': 'application/json',
                                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                                    },
                                    body: JSON.stringify({
                                        ...Object.fromEntries(formData),
                                        payment_data: cardFormData
                                    })
                                });

                                const result = await response.json();

                                if (result.success) {
                                    window.location.href = result.redirect_url;
                                } else {
                                    alert(result.message || 'Error procesando el pago');
                                }
                            } catch (error) {
                                console.error('Error:', error);
                                alert('Error procesando el pago');
                            }
                        }
                    }
                };

                await bricksBuilder.create('wallet', 'wallet_container', settings);
            }

            renderPaymentButton();
        </script>
    @endpush
</x-app-layout>
