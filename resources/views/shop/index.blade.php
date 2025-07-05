<x-app-layout>
    <x-slot name="header">
        <h2 class="shop__title">
            {{ __('Tienda') }}
        </h2>
    </x-slot>

    <div class="shop__container">
        <div class="shop__layout">
            <!-- Sidebar de Filtros -->
            <aside class="shop__sidebar">
                <h2 class="shop__sidebar-title">Filtrar productos</h2>
                <form action="{{ route('shop.index') }}" method="GET" class="shop__filters">
                    <!-- Búsqueda por nombre -->
                    <div class="shop__filter">
                        <label for="search" class="shop__filter-label">Buscar por nombre</label>
                        <input type="text" name="search" id="search" value="{{ request('search') }}"
                            class="shop__filter-input"
                            placeholder="Nombre del producto...">
                    </div>
                    <!-- Filtro por categoría -->
                    <div class="shop__filter shop__filter--accordion">
                        <button type="button" class="shop__filter-accordion-btn" onclick="toggleAccordion(this)">
                            <span class="shop__filter-label">Categoría</span>
                            <span class="shop__filter-accordion-icon">
                                <!-- Flecha abajo (cerrado) -->
                                <svg class="icon-down" width="20" height="20" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                    <polyline points="6 9 12 15 18 9"/>
                                </svg>
                                <!-- Flecha arriba (abierto) -->
                                <svg class="icon-up" width="20" height="20" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" style="display:none;">
                                    <polyline points="18 15 12 9 6 15"/>
                                </svg>
                            </span>
                        </button>
                        <div class="shop__filter-accordion-content" style="display:none;">
                            <div class="shop__filter-checkbox-group">
                                @foreach($categories as $category)
                                    <label class="shop__filter-checkbox-label">
                                        <input type="checkbox" name="categories[]" value="{{ $category->id }}"
                                            class="shop__filter-input"
                                            {{ in_array($category->id, (array)request('categories', [])) ? 'checked' : '' }}>
                                        {{ $category->name }}
                                    </label>
                                @endforeach
                            </div>
                        </div>
                    </div>
                    <!-- Filtro por marca -->
                    <div class="shop__filter">
                        <label for="brand" class="shop__filter-label">Marca</label>
                        <select name="brand" id="brand" class="shop__filter-input">
                            <option value="">Todas las marcas</option>
                            @if(isset($brands))
                                @foreach ($brands as $brand)
                                    <option value="{{ $brand->id }}" {{ request('brand') == $brand->id ? 'selected' : '' }}>{{ $brand->name }}</option>
                                @endforeach
                            @endif
                        </select>
                    </div>
                    <!-- Rango de precio predefinido -->
                    <div class="shop__filter">
                        <label for="price_range" class="shop__filter-label">Rango de precio rápido</label>
                        <select name="price_range" id="price_range" class="shop__filter-input">
                            <option value="">Todos</option>
                            <option value="0-100" {{ request('price_range') == '0-100' ? 'selected' : '' }}>$0 - $100</option>
                            <option value="100-250" {{ request('price_range') == '100-250' ? 'selected' : '' }}>$100 - $250</option>
                            <option value="250-500" {{ request('price_range') == '250-500' ? 'selected' : '' }}>$250 - $500</option>
                            <option value="500-1000" {{ request('price_range') == '500-1000' ? 'selected' : '' }}>$500 - $1000</option>
                            <option value="1000-999999" {{ request('price_range') == '1000-999999' ? 'selected' : '' }}>$1000+</option>
                        </select>
                    </div>
                    <!-- Rango de precio personalizado -->
                    <div class="shop__filter shop__filter--range">
                        <div class="shop__filter-range">
                            <label for="price_min" class="shop__filter-label">Precio mínimo</label>
                            <input type="number" name="price_min" id="price_min" value="{{ request('price_min') }}"
                                class="shop__filter-input"
                                placeholder="0">
                            <label for="price_max" class="shop__filter-label">Precio máximo</label>
                            <input type="number" name="price_max" id="price_max" value="{{ request('price_max') }}"
                                class="shop__filter-input"
                                placeholder="0">
                        </div>
                    </div>
                    <!-- Botón para enviar el formulario de filtros -->
                    <div class="shop__filter shop__filter--submit">
                        <button type="submit" class="shop__filter-button">Aplicar filtros</button>
                    </div>
                </form>
            </aside>
            <!-- Lista de productos -->
            <div class="shop__products">
                @forelse ($products as $product)
    <x-product-card :product="$product" />
@empty
    <p class="shop__empty">No hay productos para mostrar.</p>
@endforelse
                {{ $products->links() }}
            </div>
        </div>
    </div>
@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function () {
    const priceRange = document.getElementById('price_range');
    const priceMin = document.getElementById('price_min');
    const priceMax = document.getElementById('price_max');
    if (priceRange && priceMin && priceMax) {
        priceRange.addEventListener('change', function () {
            if (this.value) {
                const [min, max] = this.value.split('-');
                priceMin.value = min;
                priceMax.value = max;
            } else {
                priceMin.value = '';
                priceMax.value = '';
            }
        });
    }
});

function toggleAccordion(button) {
    const content = button.nextElementSibling;
    const isOpen = content.style.display === 'block';

    // Cerrar todos los acordeones
    document.querySelectorAll('.shop__filter-accordion-content').forEach((item) => {
        item.style.display = 'none';
    });
    document.querySelectorAll('.icon-up').forEach((icon) => {
        icon.style.display = 'none';
    });
    document.querySelectorAll('.icon-down').forEach((icon) => {
        icon.style.display = 'block';
    });

    // Si estaba cerrado, abrir el seleccionado
    if (!isOpen) {
        content.style.display = 'block';
        button.querySelector('.icon-up').style.display = 'block';
        button.querySelector('.icon-down').style.display = 'none';
    }
}
</script>
@endpush

</x-app-layout>

