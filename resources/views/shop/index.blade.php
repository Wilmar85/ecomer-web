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
                    <div class="shop__filter">
                        <label for="category" class="shop__filter-label">Categoría</label>
                        <select name="category" id="category"
                            class="shop__filter-input">
                            <option value="">Todas las categorías</option>
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}" {{ request('category') == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                            @endforeach
                            
                        </select>
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
</script>
@endpush

</x-app-layout>
