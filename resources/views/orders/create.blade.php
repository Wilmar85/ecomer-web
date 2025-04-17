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
                                <!-- Código postal eliminado y ya no es obligatorio -->
                                </div>

                                <div class="address-field">
                                    <label for="address" class="block text-sm font-medium text-gray-700">Dirección</label>
                                    <input type="text" name="address" id="address" value="{{ old('address') }}"
                                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                                </div>

                                <div class="address-field">
    <label for="city" class="block text-sm font-medium text-gray-700">Ciudad</label>
    <select name="city" id="city" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
        <option value="">Seleccione una ciudad</option>
        <option value="Bogotá" {{ old('city') == 'Bogotá' ? 'selected' : '' }}>Bogotá</option>
        <option value="Medellín" {{ old('city') == 'Medellín' ? 'selected' : '' }}>Medellín</option>
        <option value="Cali" {{ old('city') == 'Cali' ? 'selected' : '' }}>Cali</option>
    </select>
</div>
<div class="address-field">
    <label for="neighborhood" class="block text-sm font-medium text-gray-700">Barrio</label>
    <select name="neighborhood" id="neighborhood" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
        <option value="">Seleccione un barrio</option>
    </select>
</div>
<script>
    // Ciudades y barrios de ejemplo
    const neighborhoodsByCity = {
    'Bogotá': [
        'Chapinero', 'Usaquén', 'Teusaquillo', 'Suba', 'Fontibón', 'Kennedy', 'Engativá', 'Barrios Unidos', 'Puente Aranda', 'Antonio Nariño', 'Santa Fe', 'San Cristóbal', 'Ciudad Bolívar', 'Tunjuelito', 'Bosa', 'Rafael Uribe Uribe', 'La Candelaria', 'Los Mártires', 'Sumapaz'
    ],
    'Medellín': [
        'El Poblado', 'Laureles', 'Belen', 'Castilla', 'Robledo', 'Manrique', 'Aranjuez', 'Buenos Aires', 'San Javier', 'La América', 'La Candelaria', 'Doce de Octubre', 'Guayabal', 'San Antonio de Prado', 'Santa Cruz', 'Popular', 'Villa Hermosa'
    ],
    'Cali': [
        'San Fernando', 'Granada', 'El Peñón', 'Aguablanca', 'Ciudad Jardín', 'San Antonio', 'La Flora', 'Versalles', 'El Ingenio', 'Santa Mónica', 'La Merced', 'Alfonso López', 'Siloé', 'Meléndez', 'San Nicolás', 'Sucre'
    ],
    'Barranquilla': [
        'El Prado', 'Alto Prado', 'Villa Country', 'Ciudad Jardín', 'Boston', 'La Concepción', 'Las Delicias', 'San Vicente', 'Rebolo', 'La Unión', 'Las Nieves', 'Montecristo', 'La Ceiba', 'El Recreo'
    ],
    'Cartagena': [
        'Getsemaní', 'Bocagrande', 'Manga', 'El Cabrero', 'La Matuna', 'Pie de la Popa', 'Crespo', 'Chambacú', 'San Diego', 'Torices', 'La Boquilla', 'El Bosque', 'Olaya Herrera'
    ],
    'Bucaramanga': [
        'Cabecera', 'Alarcón', 'Antonia Santos', 'Provenza', 'La Concordia', 'Mutis', 'San Alonso', 'San Francisco', 'La Universidad', 'Sotomayor', 'Girardot', 'La Feria'
    ],
    'Pereira': [
        'Cuba', 'Alamos', 'Centro', 'Boston', 'San Joaquín', 'Villavicencio', 'El Jardín', 'San Nicolás', 'La Circunvalar', 'Villa Santana', 'Kennedy', 'San Fernando'
    ],
    'Manizales': [
        'Palogrande', 'La Enea', 'Chipre', 'El Cable', 'San Jorge', 'La Francia', 'Centro', 'Malhabar', 'Los Rosales', 'Villa Pilar', 'Campohermoso', 'Villahermosa'
    ],
    'Cúcuta': [
        'La Ceiba', 'Caobos', 'Centro', 'La Riviera', 'Guaimaral', 'San Luis', 'San Rafael', 'El Contento', 'La Playa', 'Motilones', 'Los Caobos', 'La Cabrera'
    ]
};

// También actualiza el select de ciudades
const citySelect = document.getElementById('city');
citySelect.innerHTML = '<option value="">Seleccione una ciudad</option>';
Object.keys(neighborhoodsByCity).forEach(function(city) {
    const opt = document.createElement('option');
    opt.value = city;
    opt.textContent = city;
    if ("{{ old('city') }}" === city) opt.selected = true;
    citySelect.appendChild(opt);
});
    document.getElementById('city').addEventListener('change', function() {
        const city = this.value;
        const neighborhoodSelect = document.getElementById('neighborhood');
        neighborhoodSelect.innerHTML = '<option value="">Seleccione un barrio</option>';
        if (neighborhoodsByCity[city]) {
            neighborhoodsByCity[city].forEach(function(barrio) {
                const opt = document.createElement('option');
                opt.value = barrio;
                opt.textContent = barrio;
                neighborhoodSelect.appendChild(opt);
            });
        }
    });
    // Preselect neighborhood if old value exists
    document.addEventListener('DOMContentLoaded', function() {
        const city = document.getElementById('city').value;
        const oldNeighborhood = "{{ old('neighborhood') }}";
        const neighborhoodSelect = document.getElementById('neighborhood');
        if (neighborhoodsByCity[city]) {
            neighborhoodsByCity[city].forEach(function(barrio) {
                const opt = document.createElement('option');
                opt.value = barrio;
                opt.textContent = barrio;
                if (oldNeighborhood === barrio) opt.selected = true;
                neighborhoodSelect.appendChild(opt);
            });
        }
    });
</script>
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
                                @foreach ($paymentMethods as $key => $label)
                                    <div class="flex items-center">
                                        <input type="radio" name="payment_method" id="{{ $key }}" value="{{ $key }}"
                                            class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300"
                                            {{ old('payment_method', 'card') == $key ? 'checked' : '' }}>
                                        <label for="{{ $key }}" class="ml-3 block text-sm font-medium text-gray-700">
                                            {{ $label }}
                                        </label>
                                    </div>
                                @endforeach
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
