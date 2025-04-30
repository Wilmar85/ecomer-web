<x-app-layout>
    <div class="products-shop__section">
        <div class="products-shop__container">
            <div class="products-shop__layout">
                <!-- Sidebar de Filtros -->
                <aside class="products-shop__sidebar">
                    <div class="products-shop__spacer">
                        <h2 class="products-shop__filter-title">Filtrar productos</h2>
                        <hr class="products-shop__divider">
                    </div>
                    <form action="{{ route('shop.index') }}" method="GET" class="products-shop__form-spacer">
    <div>
        <label class="products-shop__filter-label">Marca</label>
        <select name="brand" class="products-shop__filter-input">
            <option value="">Todas</option>
            @foreach ($brands as $brand)
                <option value="{{ $brand->id }}" {{ request('brand') == $brand->id ? 'selected' : '' }}>{{ $brand->name }}</option>
            @endforeach
        </select>
    </div>
                        <div>
                            <label class="products-shop__filter-label">Buscar</label>
                            <input type="text" name="search" value="{{ request('search') }}" class="products-shop__filter-input" placeholder="Buscar productos...">
                        </div>
                        <div>
                            <label class="products-shop__filter-label">Categoría</label>
                            <select name="category" class="products-shop__filter-input">
                                <option value="">Todas</option>
                                @foreach ($categories as $category)
                                    <option value="{{ $category->slug }}" {{ request('category') == $category->slug ? 'selected' : '' }}>{{ $category->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="products-shop__price-row">
                            <div class="products-shop__price-col">
                                <label class="products-shop__filter-label">Precio mín</label>
                                <input type="number" name="price_min" step="0.01" value="{{ request('price_min') }}" class="products-shop__filter-input" placeholder="0">
                            </div>
                            <div class="products-shop__price-col">
                                <label class="products-shop__filter-label">Precio máx</label>
                                <input type="number" name="price_max" step="0.01" value="{{ request('price_max') }}" class="products-shop__filter-input" placeholder="99999">
                            </div>
                        </div>
                        
                        <div>
                            <label class="products-shop__filter-label">Stock</label>
                            <select name="stock" class="products-shop__filter-input">
                                <option value="">Todos</option>
                                <option value="in" {{ request('stock') == 'in' ? 'selected' : '' }}>En stock</option>
                                <option value="out" {{ request('stock') == 'out' ? 'selected' : '' }}>Sin stock</option>
                            </select>
                        </div>
                        <div>
                            <label class="products-shop__filter-label">Ordenar por</label>
                            <select name="sort" class="products-shop__filter-input">
                                <option value="">Relevancia</option>
                                <option value="price_asc" {{ request('sort') == 'price_asc' ? 'selected' : '' }}>Precio: menor a mayor</option>
                                <option value="price_desc" {{ request('sort') == 'price_desc' ? 'selected' : '' }}>Precio: mayor a menor</option>
                                <option value="name_asc" {{ request('sort') == 'name_asc' ? 'selected' : '' }}>Nombre A-Z</option>
                                <option value="name_desc" {{ request('sort') == 'name_desc' ? 'selected' : '' }}>Nombre Z-A</option>
                            </select>
                        </div>
                        <div class="products-shop__filter-btn-row">
                            <button type="submit" class="products-shop__filter-btn">
                                Filtrar
                            </button>
                        </div>
                    </form>
                </aside>

                <!-- Main: grid de productos -->
                <main class="products-shop__main">
                    <div class="products-shop__grid">
                        @forelse ($products as $product)
                            <x-product-card :product="$product" />
                            @if ($product->images->isNotEmpty())
                                <div class="products-shop__img-aspect">
                                    <img src="{{ asset('storage/' . $product->images->first()->path) }}"
                                        alt="{{ $product->name }}"
                                        class="products-shop__img">
                                </div>
                            @endif
                            <div class="products-shop__card-body">
                                <h3 class="products-shop__card-title">{{ $product->name }}</h3>
                                <p class="products-shop__card-desc">{{ Str::limit($product->description, 100) }}</p>
                                <div class="products-shop__card-footer">
                                    <span class="products-shop__price">${{ number_format($product->price, 2) }}</span>
                                    <a href="{{ route('products.show', $product) }}"
                                        class="products-shop__details-btn">
                                        Ver Detalles
                                    </a>
                                </div>
                                <div class="products-shop__mt">
                                    @auth
                                        <form action="{{ route('cart.add') }}" method="POST" class="products-shop__form-inline">
                                            @csrf
                                            <input type="hidden" name="product_id" value="{{ $product->id }}">
                                            <button type="submit" class="products-shop__add-btn">
                                                Añadir a la tienda
                                            </button>
                                        </form>
                                    @else
                                        <a href="{{ route('register') }}" class="products-shop__add-btn--tertiary">
                                            Añadir a la tienda
                                        </a>
                                    @endauth
</div>
                                </div>
                            </div>
                        @empty
                            <div class="col-span-full text-center py-12">
                                <p class="products-shop__empty">No se encontraron productos.</p>
                            </div>
                        @endforelse
                    </div>

                    <!-- Paginación -->
                    <div class="mt-8">
                        {{ $products->links() }}
                    </div>
                </main>
            </div>