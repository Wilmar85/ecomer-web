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
                        <form action="{{ route('checkout.process') }}" method="POST" id="shipping-form" class="space-y-4">
                            @csrf
                            
                            <!-- Método de Pago -->
                            <div class="mb-4">
                                <label for="payment_method" class="block text-sm font-medium text-gray-700 mb-2">Método de Pago</label>
                                <select name="payment_method" id="payment_method" class="block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" required>
                                    <option value="cash">Pago en Efectivo</option>
                                    <option value="mercadopago">Mercado Pago</option>
                                </select>
                            </div>

                            <!-- Método de Envío -->
                            <div class="mb-4">
                                <label for="shipping_method" class="block text-sm font-medium text-gray-700 mb-2">Método de Envío</label>
                                <select name="shipping_method" id="shipping_method" class="block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" required>
                                    <option value="pickup">Retiro en Tienda</option>
                                    <option value="delivery">Envío a Domicilio</option>
                                </select>
                            </div>

                            <!-- Dirección de Envío -->
                            <div id="shippingAddressFields">
                                <div class="mb-4">
                                    <label for="street" class="block text-sm font-medium text-gray-700 mb-2">Calle y Número</label>
                                    <input type="text" class="block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" id="street" name="street" required>
                                </div>
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                                    <div>
                                        <label for="city" class="block text-sm font-medium text-gray-700 mb-2">Ciudad</label>
                                        <input type="text" class="block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" id="city" name="city" required>
                                    </div>
                                    <div>
                                        <label for="state" class="block text-sm font-medium text-gray-700 mb-2">Estado</label>
                                        <input type="text" class="block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" id="state" name="state" required>
                                    </div>
                                </div>
                                <div class="mb-4">
                                    <label for="phone" class="block text-sm font-medium text-gray-700 mb-2">Teléfono</label>
                                    <input type="tel" class="block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" id="phone" name="phone" pattern="[0-9]{9,}" title="Por favor ingrese un número de teléfono válido (mínimo 9 dígitos)" required>
                                    <div class="mt-1 text-sm text-red-600 hidden" id="phone-error"></div>
                                </div>
                            </div>

                            <!-- Botón de Continuar -->
                            <div class="mt-6">
                                <button type="submit" class="w-full flex justify-center py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" id="continueButton">
                                    Continuar con la Compra
                                </button>
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
                                            <h4 class="text-sm font-medium text-gray-900">{{ $item->product->name }}</h4>
                                            <div class="mt-1 flex flex-col text-sm text-gray-500">
                                                <span>Cantidad: {{ $item->quantity }}</span>
                                                @if($item->product->sku)
                                                    <span>SKU: {{ $item->product->sku }}</span>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="text-right">
                                            <div class="text-sm font-medium text-gray-900">
                                                ${{ number_format($item->subtotal, 2) }}
                                            </div>
                                            <div class="text-xs text-gray-500">
                                                ${{ number_format($item->product->price, 2) }} c/u
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>

                            <!-- Resumen de Costos -->
                            <div class="border-t border-gray-200 pt-4 space-y-2">
                                <div class="flex justify-between text-sm">
                                    <span class="text-gray-600">Subtotal</span>
                                    <span class="text-gray-900">${{ number_format($subtotal, 2) }}</span>
                                </div>
                                <div class="flex justify-between text-sm">
                                    <span class="text-gray-600">Envío</span>
                                    <span class="text-gray-900">${{ number_format($shipping, 2) }}</span>
                                </div>
                                <div class="flex justify-between text-sm">
                                    <span class="text-gray-600">IVA (19%)</span>
                                    <span class="text-gray-900">${{ number_format(($subtotal + $shipping) * 0.19, 2) }}</span>
                                </div>
                                <div class="flex justify-between text-base font-medium pt-2 border-t border-gray-100">
                                    <span class="text-gray-900">Total (IVA incluido)</span>
                                    <span class="text-gray-900">${{ number_format(($subtotal + $shipping) * 1.19, 2) }}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
    <script>
    document.addEventListener('DOMContentLoaded', function() {
        // Validar stock al cargar la página
        validateStock();

        const paymentMethod = document.getElementById('payment_method');
        const shippingMethod = document.getElementById('shipping_method');
        const shippingAddressFields = document.getElementById('shippingAddressFields');
        const streetInput = document.getElementById('street');
        const cityInput = document.getElementById('city');
        const stateInput = document.getElementById('state');
        const shippingForm = document.getElementById('shipping-form');
        
        function updateShippingFields() {
            const isPickup = shippingMethod.value === 'pickup';
            const isCashPayment = paymentMethod.value === 'cash';
            
            // Si es pago en efectivo, forzar recoger en tienda
            if (isCashPayment) {
                shippingMethod.value = 'pickup';
                shippingMethod.disabled = true;
            } else {
                shippingMethod.disabled = false;
            }
            
            shippingAddressFields.style.display = isPickup ? 'none' : 'block';
            
            // Deshabilitar/habilitar campos
            streetInput.disabled = isPickup;
            cityInput.disabled = isPickup;
            stateInput.disabled = isPickup;
            
            // Actualizar el atributo required
            streetInput.required = !isPickup;
            cityInput.required = !isPickup;
            stateInput.required = !isPickup;
        }
        
        // Ejecutar al cargar la página
        updateShippingFields();
        
        // Ejecutar cuando cambie el método de envío o el método de pago
        shippingMethod.addEventListener('change', updateShippingFields);
        paymentMethod.addEventListener('change', updateShippingFields);

        // Función para validar stock
        async function validateStock() {
            try {
                const response = await fetch('{{ route('checkout.validate-stock') }}', {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                        'Content-Type': 'application/json',
                    },
                    body: JSON.stringify({})
                });
                
                const data = await response.json();
                
                if (!data.valid) {
                    alert(data.message);
                    document.getElementById('continueButton').disabled = true;
                } else {
                    document.getElementById('continueButton').disabled = false;
                }
            } catch (error) {
                console.error('Error al validar stock:', error);
                document.getElementById('continueButton').disabled = true;
            }
        }

        // Manejar el envío del formulario
        shippingForm.addEventListener('submit', async function(e) {
            e.preventDefault();
            
            // Validar el teléfono antes de enviar
            const phoneRegex = /^[0-9]{9,}$/;
            const isPhoneValid = phoneRegex.test(phoneInput.value);
            
            if (!isPhoneValid) {
                phoneError.textContent = 'Por favor ingrese un número de teléfono válido';
                phoneError.classList.remove('hidden');
                return;
            }

            const continueButton = document.getElementById('continueButton');
            continueButton.disabled = true;

            try {
                const formData = new FormData(shippingForm);
                const formDataObject = {};
                formData.forEach((value, key) => {
                    formDataObject[key] = value;
                });

                const response = await fetch('{{ route('checkout.process') }}', {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                        'Accept': 'application/json',
                        'Content-Type': 'application/json',
                    },
                    body: JSON.stringify(formDataObject)
                });

                const result = await response.json();

                if (result.success) {
                    if (paymentMethod.value === 'cash') {
                        alert('¡Pedido realizado con éxito! Se ha generado un ticket para recoger en tienda.');
                    }
                    window.location.href = result.redirect_url;
                } else {
                    alert(result.message || 'Ha ocurrido un error al procesar el pedido.');
                    continueButton.disabled = false;
                }
            } catch (error) {
                console.error('Error al procesar el pedido:', error);
                alert('Ha ocurrido un error al procesar el pedido.');
                continueButton.disabled = false;
            }
        });
    });
    </script>
    @endpush
    @push('scripts')
    <script>
    document.addEventListener('DOMContentLoaded', function() {
        // Validar stock al cargar la página
        validateStock();

        const paymentMethod = document.getElementById('payment_method');
        const shippingMethod = document.getElementById('shipping_method');
        const shippingAddressFields = document.getElementById('shippingAddressFields');
        const streetInput = document.getElementById('street');
        const cityInput = document.getElementById('city');
        const stateInput = document.getElementById('state');
        const shippingForm = document.getElementById('shipping-form');
        
        function updateShippingFields() {
            const isPickup = shippingMethod.value === 'pickup';
            const isCashPayment = paymentMethod.value === 'cash';
            
            // Si es pago en efectivo, forzar recoger en tienda
            if (isCashPayment) {
                shippingMethod.value = 'pickup';
                shippingMethod.disabled = true;
            } else {
                shippingMethod.disabled = false;
            }
            
            shippingAddressFields.style.display = isPickup ? 'none' : 'block';
            
            // Deshabilitar/habilitar campos
            streetInput.disabled = isPickup;
            cityInput.disabled = isPickup;
            stateInput.disabled = isPickup;
            
            // Actualizar el atributo required
            streetInput.required = !isPickup;
            cityInput.required = !isPickup;
            stateInput.required = !isPickup;
        }
        
        // Ejecutar al cargar la página
        updateShippingFields();
        
        // Ejecutar cuando cambie el método de envío o el método de pago
        shippingMethod.addEventListener('change', updateShippingFields);
        paymentMethod.addEventListener('change', updateShippingFields);

        // Función para validar stock
        async function validateStock() {
            try {
                const response = await fetch('{{ route('checkout.validate-stock') }}', {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                        'Content-Type': 'application/json',
                    },
                    body: JSON.stringify({})
                });
                
                const data = await response.json();
                
                if (!data.valid) {
                    alert(data.message);
                    document.getElementById('continueButton').disabled = true;
                } else {
                    document.getElementById('continueButton').disabled = false;
                }
            } catch (error) {
                console.error('Error al validar stock:', error);
                document.getElementById('continueButton').disabled = true;
            }
        }

        // Manejar el envío del formulario
        const phoneInput = document.getElementById('phone');
        const phoneError = document.getElementById('phone-error');

        // Validación del campo teléfono
        phoneInput.addEventListener('input', function() {
            const phoneRegex = /^[0-9]{9,}$/;
            const isValid = phoneRegex.test(this.value);
            
            if (!isValid) {
                phoneError.textContent = 'Por favor ingrese un número de teléfono válido (mínimo 9 dígitos)';
                phoneError.classList.remove('hidden');
                this.setAttribute('aria-invalid', 'true');
            } else {
                phoneError.classList.add('hidden');
                this.removeAttribute('aria-invalid');
            }
        });

        // Validación antes de enviar el formulario
        shippingForm.addEventListener('submit', async function(e) {
            e.preventDefault();
            
            // Validar el teléfono antes de enviar
            const phoneRegex = /^[0-9]{9,}$/;
            const isPhoneValid = phoneRegex.test(phoneInput.value);
            
            if (!isPhoneValid) {
                phoneError.textContent = 'Por favor ingrese un número de teléfono válido';
                phoneError.classList.remove('hidden');
                return;
            }

            const continueButton = document.getElementById('continueButton');
            continueButton.disabled = true;

            try {
                const formData = new FormData(shippingForm);
                const formDataObject = {};
                formData.forEach((value, key) => {
                    formDataObject[key] = value;
                });

                const response = await fetch('{{ route('checkout.process') }}', {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                        'Accept': 'application/json',
                        'Content-Type': 'application/json',
                    },
                    body: JSON.stringify(formDataObject)
                });

                const result = await response.json();

                if (result.success) {
                    if (paymentMethod.value === 'cash') {
                        alert('¡Pedido realizado con éxito! Se ha generado un ticket para recoger en tienda.');
                    }
                    window.location.href = result.redirect_url;
                } else {
                    alert(result.message || 'Ha ocurrido un error al procesar el pedido.');
                    continueButton.disabled = false;
                }
            } catch (error) {
                console.error('Error al procesar el pedido:', error);
                alert('Ha ocurrido un error al procesar el pedido.');
                continueButton.disabled = false;
            }
        });
    });
    </script>
    @endpush
</x-app-layout>
