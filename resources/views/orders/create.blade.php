<x-app-layout>
    <x-slot name="header">
        <h2 class="orders-create__header">
            {{ __('Finalizar Compra') }}
        </h2>
    </x-slot>

    <div class="orders-create__section">
        <div class="orders-create__container">
            <div class="orders-create__card">
                <div class="orders-create__content">
                    @if ($errors->any())
                        <div class="orders-create__alert orders-create__alert--error"
                            role="alert">
                            <ul class="orders-create__error-list">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{ route('orders.store') }}" method="POST" class="orders-create__form" enctype="multipart/form-data">
                        @csrf

                        <!-- Resumen del pedido -->
                        <div class="orders-create__summary">
                            <h3 class="orders-create__subtitle">Resumen del Pedido</h3>
                                            </div>
                                        @endif
                                        <div>
                                            <h4 class="orders-create__summary-name">{{ $item->product->name }}</h4>
                                            <p class="orders-create__summary-qty">Cantidad: {{ $item->quantity }}</p>
                                        </div>
                                    </div>
                                    <p class="orders-create__summary-price">
                                        ${{ number_format($item->subtotal, 2) }}</p>
                                </div>
                            @endforeach

                            <div class="orders-create__summary-total">
                                <div class="orders-create__summary-total-row">
                                    <p class="orders-create__summary-total-label">Total</p>
                                    <p class="orders-create__summary-total-value">${{ number_format($cart->total, 2) }}</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Método de entrega -->
                    <div class="orders-create__delivery-method">
                        <h3 class="orders-create__subtitle">Método de Entrega</h3>
                        <div class="orders-create__delivery-method-list">
                            <div class="orders-create__delivery-method-item">
                                <input type="radio" name="delivery_method" id="delivery" value="delivery"
                                       class="orders-create__radio" checked
                                       onchange="toggleAddressFields()">
                                <label for="delivery" class="orders-create__label">
                                    Envío a domicilio
                                </label>
                        <div class="orders-create__shipping-fields" id="shipping-info">
                            <h3 class="orders-create__subtitle">Información de Envío</h3>

                            <div class="orders-create__shipping-grid">
    <div>
        <label for="name" class="orders-create__label">Nombre completo</label>
        <input type="text" name="name" id="name" value="{{ old('name', auth()->user()->name) }}" class="orders-create__input" required>
    </div>
    <div>
        <label for="email" class="orders-create__label">Correo electrónico</label>
        <input type="email" name="email" id="email" value="{{ old('email', auth()->user()->email) }}" class="orders-create__input" required>
    </div>
    <div>
        <label for="phone" class="orders-create__label">Teléfono</label>
        <input type="tel" name="phone" id="phone" value="{{ old('phone') }}" class="orders-create__input" required>
        <!-- Código postal eliminado y ya no es obligatorio -->
    </div>
    <div class="address-field">
        <label for="address" class="orders-create__label">Dirección</label>
        <input type="text" name="address" id="address" value="{{ old('address') }}" class="orders-create__input">
    </div>
    <div class="address-field">
        <label for="city" class="orders-create__label">Ciudad</label>
        <select name="city" id="city" class="orders-create__input">
            <option value="">Seleccione una ciudad</option>
            <option value="Bogotá" {{ old('city') == 'Bogotá' ? 'selected' : '' }}>Bogotá</option>
            <option value="Medellín" {{ old('city') == 'Medellín' ? 'selected' : '' }}>Medellín</option>
            <option value="Cali" {{ old('city') == 'Cali' ? 'selected' : '' }}>Cali</option>
        </select>
    </div>
</div>
<!-- Departamento fuera del grid para máxima visibilidad -->
<div class="address-field" style="margin-top: 1rem; border:2px solid red; background:#fffbe7; padding:1rem;">
    <span style="color:red; font-weight:bold;">Aquí debe aparecer el departamento</span>
    <label for="state" class="orders-create__label">Departamento</label>
    <select name="state" id="state" class="orders-create__input">
        <option value="">Seleccione un departamento</option>
        <option value="Amazonas" {{ old('state') == 'Amazonas' ? 'selected' : '' }}>Amazonas</option>
        <option value="Antioquia" {{ old('state') == 'Antioquia' ? 'selected' : '' }}>Antioquia</option>
        <option value="Arauca" {{ old('state') == 'Arauca' ? 'selected' : '' }}>Arauca</option>
        <option value="Atlántico" {{ old('state') == 'Atlántico' ? 'selected' : '' }}>Atlántico</option>
        <option value="Bolívar" {{ old('state') == 'Bolívar' ? 'selected' : '' }}>Bolívar</option>
        <option value="Boyacá" {{ old('state') == 'Boyacá' ? 'selected' : '' }}>Boyacá</option>
        <option value="Caldas" {{ old('state') == 'Caldas' ? 'selected' : '' }}>Caldas</option>
        <option value="Caquetá" {{ old('state') == 'Caquetá' ? 'selected' : '' }}>Caquetá</option>
        <option value="Casanare" {{ old('state') == 'Casanare' ? 'selected' : '' }}>Casanare</option>
        <option value="Cauca" {{ old('state') == 'Cauca' ? 'selected' : '' }}>Cauca</option>
        <option value="Cesar" {{ old('state') == 'Cesar' ? 'selected' : '' }}>Cesar</option>
        <option value="Chocó" {{ old('state') == 'Chocó' ? 'selected' : '' }}>Chocó</option>
        <option value="Córdoba" {{ old('state') == 'Córdoba' ? 'selected' : '' }}>Córdoba</option>
        <option value="Cundinamarca" {{ old('state') == 'Cundinamarca' ? 'selected' : '' }}>Cundinamarca</option>
        <option value="Guainía" {{ old('state') == 'Guainía' ? 'selected' : '' }}>Guainía</option>
        <option value="Guaviare" {{ old('state') == 'Guaviare' ? 'selected' : '' }}>Guaviare</option>
        <option value="Huila" {{ old('state') == 'Huila' ? 'selected' : '' }}>Huila</option>
        <option value="La Guajira" {{ old('state') == 'La Guajira' ? 'selected' : '' }}>La Guajira</option>
        <option value="Magdalena" {{ old('state') == 'Magdalena' ? 'selected' : '' }}>Magdalena</option>
        <option value="Meta" {{ old('state') == 'Meta' ? 'selected' : '' }}>Meta</option>
        <option value="Nariño" {{ old('state') == 'Nariño' ? 'selected' : '' }}>Nariño</option>
        <option value="Norte de Santander" {{ old('state') == 'Norte de Santander' ? 'selected' : '' }}>Norte de Santander</option>
        <option value="Putumayo" {{ old('state') == 'Putumayo' ? 'selected' : '' }}>Putumayo</option>
        <option value="Quindío" {{ old('state') == 'Quindío' ? 'selected' : '' }}>Quindío</option>
        <option value="Risaralda" {{ old('state') == 'Risaralda' ? 'selected' : '' }}>Risaralda</option>
        <option value="San Andrés y Providencia" {{ old('state') == 'San Andrés y Providencia' ? 'selected' : '' }}>San Andrés y Providencia</option>
        <option value="Santander" {{ old('state') == 'Santander' ? 'selected' : '' }}>Santander</option>
        <option value="Sucre" {{ old('state') == 'Sucre' ? 'selected' : '' }}>Sucre</option>
        <option value="Tolima" {{ old('state') == 'Tolima' ? 'selected' : '' }}>Tolima</option>
        <option value="Valle del Cauca" {{ old('state') == 'Valle del Cauca' ? 'selected' : '' }}>Valle del Cauca</option>
        <option value="Vaupés" {{ old('state') == 'Vaupés' ? 'selected' : '' }}>Vaupés</option>
        <option value="Vichada" {{ old('state') == 'Vichada' ? 'selected' : '' }}>Vichada</option>
    </select>
</div>
<div class="address-field">
    <label for="neighborhood" class="block text-sm font-medium text-gray-700">Barrio</label>
    <select name="neighborhood" id="neighborhood" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
        <option value="">Seleccione un barrio</option>
    </select>
</div>
<script>
    // Mostrar/ocultar campos de dirección según método de entrega
    function toggleAddressFields() {
        var delivery = document.getElementById('delivery');
        var addressFields = document.querySelectorAll('.address-field');
        addressFields.forEach(function(field) {
            field.style.display = delivery.checked ? 'block' : 'none';
        });
    }
    document.addEventListener('DOMContentLoaded', function() {
        toggleAddressFields();
        document.getElementById('delivery').addEventListener('change', toggleAddressFields);
        document.getElementById('pickup').addEventListener('change', toggleAddressFields);
    });

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
                        <div class="orders-create__shipping-fields">
                            <h3 class="orders-create__subtitle">Método de Pago</h3>

                            <div class="orders-create__payment-fields">
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

                        <!-- Comprobante de pago solo si es efectivo -->
                        <div id="payment-proof-field" style="display: none;">
                            <label for="payment_proof" class="block text-sm font-medium text-gray-700">Comprobante de pago (opcional, imagen o PDF)</label>
                            <input type="file" name="payment_proof" id="payment_proof" accept="image/*,application/pdf" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
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
                        <script>
                        // Mostrar campo comprobante solo si es efectivo
                        document.addEventListener('DOMContentLoaded', function() {
                            function toggleProof() {
                                var proof = document.getElementById('payment-proof-field');
                                var cash = document.getElementById('cash');
                                proof.style.display = cash && cash.checked ? 'block' : 'none';
                            }
                            document.querySelectorAll('input[name=payment_method]').forEach(function(el) {
                                el.addEventListener('change', toggleProof);
                            });
                            toggleProof();
                        });
                        </script>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
