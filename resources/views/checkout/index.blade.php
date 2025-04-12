<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Finalizar Compra') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <!-- Formulario de Envío y Pago -->
                <div class="md:col-span-2">
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                        <h3 class="text-lg font-medium text-gray-900 mb-4">Información de Envío y Pago</h3>
                        <form action="{{ route('checkout.process') }}" method="POST" id="checkout-form" class="space-y-4">
                            @csrf
                            
                            <!-- Información Personal -->
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <div>
                                    <label for="name" class="block text-sm font-medium text-gray-700">Nombre Completo</label>
                                    <input type="text" name="name" id="name" value="{{ auth()->user()->name }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" required>
                                </div>
                                <div>
                                    <label for="phone" class="block text-sm font-medium text-gray-700">Teléfono</label>
                                    <input type="tel" name="phone" id="phone" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" required>
                                </div>
                            </div>

                            <!-- Método de Envío -->
                            <div class="mt-4">
                                <label class="block text-sm font-medium text-gray-700 mb-2">Método de Envío</label>
                                <div class="space-y-2">
                                    <div class="flex items-center">
                                        <input type="radio" name="shipping_method" id="delivery" value="delivery" class="h-4 w-4 text-indigo-600 focus:ring-indigo-500 border-gray-300" checked>
                                        <label for="delivery" class="ml-2 block text-sm text-gray-700">Envío a Domicilio</label>
                                    </div>
                                    <div class="flex items-center">
                                        <input type="radio" name="shipping_method" id="pickup" value="pickup" class="h-4 w-4 text-indigo-600 focus:ring-indigo-500 border-gray-300">
                                        <label for="pickup" class="ml-2 block text-sm text-gray-700">Recoger en Tienda</label>
                                    </div>
                                </div>
                            </div>

                            <!-- Dirección de Envío (visible solo para envío a domicilio) -->
                            <div id="shipping-address-section">
                                <div class="mt-4">
                                    <label for="street" class="block text-sm font-medium text-gray-700">Dirección</label>
                                    <input type="text" name="street" id="street" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                                </div>

                                <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mt-4">
                                    <div>
                                        <label for="city" class="block text-sm font-medium text-gray-700">Ciudad</label>
                                        <input type="text" name="city" id="city" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                                    </div>
                                    <div>
                                        <label for="state" class="block text-sm font-medium text-gray-700">Estado</label>
                                        <input type="text" name="state" id="state" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                                    </div>
                                    <div>
                                        <label for="postal_code" class="block text-sm font-medium text-gray-700">Código Postal</label>
                                        <input type="text" name="postal_code" id="postal_code" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                                    </div>
                                </div>
                            </div>

                            <!-- Método de Pago -->
                            <div class="mt-6">
                                <label for="payment_method" class="block text-sm font-medium text-gray-700">Método de Pago</label>
                                <select name="payment_method" id="payment_method" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" required>
                                    <option value="cash">Pago en Efectivo</option>
                                    <option value="mercadopago">Mercado Pago</option>
                                </select>
                            </div>

                            <div class="mt-6">
                                <button type="submit" class="w-full bg-indigo-600 text-white py-2 px-4 rounded-md hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">
                                    Confirmar Pedido
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
                            @foreach($cartItems as $item)
                            <div class="flex justify-between items-center py-2 border-b">
                                <div>
                                    <p class="text-sm font-medium text-gray-900">{{ $item->product->name }}</p>
                                    <p class="text-sm text-gray-500">Cantidad: {{ $item->quantity }}</p>
                                </div>
                                <p class="text-sm font-medium text-gray-900">${{ number_format($item->subtotal, 2) }}</p>
                            </div>
                            @endforeach

                            <div class="border-t pt-4 space-y-2">
                                <div class="flex justify-between text-sm">
                                    <span class="text-gray-600">Subtotal</span>
                                    <span class="font-medium">${{ number_format($subtotal, 2) }}</span>
                                </div>
                                <div class="flex justify-between text-sm">
                                    <span class="text-gray-600">Envío</span>
                                    <span id="shipping-cost" class="font-medium">${{ number_format($shipping, 2) }}</span>
                                </div>
                                <div class="flex justify-between text-base font-medium">
                                    <span class="text-gray-900">Total</span>
                                    <span id="total-amount" class="text-gray-900">${{ number_format($total, 2) }}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        // Función para manejar la visibilidad de los campos de dirección
        function toggleShippingFields() {
            const shippingMethod = document.querySelector('input[name="shipping_method"]:checked').value;
            const shippingAddressSection = document.getElementById('shipping-address-section');
            const shippingFields = shippingAddressSection.querySelectorAll('input');
            
            if (shippingMethod === 'delivery') {
                shippingAddressSection.style.display = 'block';
                shippingFields.forEach(field => field.required = true);
                document.getElementById('shipping-cost').textContent = '$10.00';
                updateTotal(10);
            } else {
                shippingAddressSection.style.display = 'none';
                shippingFields.forEach(field => field.required = false);
                document.getElementById('shipping-cost').textContent = '$0.00';
                updateTotal(0);
            }
        }

        // Función para actualizar el total
        function updateTotal(shippingCost) {
            const subtotal = {{ $subtotal }};
            const total = subtotal + shippingCost;
            document.getElementById('total-amount').textContent = '$' + total.toFixed(2);
        }

        // Agregar event listeners
        document.querySelectorAll('input[name="shipping_method"]').forEach(radio => {
            radio.addEventListener('change', toggleShippingFields);
        });

        // Inicializar estado
        toggleShippingFields();

        document.getElementById('checkout-form').addEventListener('submit', async function(e) {
            e.preventDefault();
            
            // Validar stock antes de procesar
            try {
                try {
                    const response = await fetch('{{ route("checkout.validate-stock") }}');
                    if (!response.ok) {
                        throw new Error('Error al validar el stock');
                    }
                    const data = await response.json();
                    
                    if (!data.valid) {
                        Swal.fire({
                            icon: 'error',
                            title: 'Error de Stock',
                            text: data.message,
                            confirmButtonText: 'Entendido'
                        });
                        return;
                    }
                
                // Procesar el formulario
                const formData = new FormData(this);
                const processResponse = await fetch(this.action, {
                    method: 'POST',
                    body: formData,
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    }
                });
                
                const result = await processResponse.json();
                
                if (result.success) {
                    window.location.href = result.redirect_url;
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error en el Proceso',
                        text: result.message || 'Hubo un error al procesar tu pedido. Por favor, verifica tus datos e intenta nuevamente.',
                        confirmButtonText: 'Entendido'
                    });
                }
            } catch (error) {
                console.error('Error:', error);
                Swal.fire({
                    icon: 'error',
                    title: 'Error en la Compra',
                    text: 'Hubo un error al procesar tu pedido. Por favor, verifica tu conexión e intenta nuevamente.',
                    confirmButtonText: 'Entendido'
                });
            }
        });
    </script>
    @endpush
</x-app-layout>