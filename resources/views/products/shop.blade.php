<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="flex flex-col sm:flex-row gap-8">
                <!-- Sidebar de Filtros -->
                <aside class="products-shop__sidebar">
                    <div class="mb-6">
                        <h2 class="products-shop__filter-title">Filtrar productos</h2>
                        <hr class="border-gray-200 mb-4">
                    </div>
                    <form action="{{ route('shop.index') }}" method="GET" class="space-y-6">
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
                        <div class="flex gap-2">
                            <div class="flex-1">
                                <label class="products-shop__filter-label">Precio mín</label>
                                <input type="number" name="price_min" step="0.01" value="{{ request('price_min') }}" class="products-shop__filter-input" placeholder="0">
                            </div>
                            <div class="flex-1">
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
                        <button type="submit" class="products-shop__filter-btn">Filtrar</button>
                    </form>
                </aside>

                <!-- Main: grid de productos -->
                <main class="products-shop__main">
                    <div class="products-shop__grid">
                        @forelse ($products as $product)
    <x-product-card :product="$product" />
                                @if ($product->images->isNotEmpty())
                                    <div class="aspect-w-3 aspect-h-2">
                                        <img src="{{ asset('storage/' . $product->images->first()->path) }}"
                                            alt="{{ $product->name }}"
                                            class="w-full h-48 object-cover object-center group-hover:opacity-75">
                                    </div>
                                @endif
                                <div class="p-4">
                                    <h3 class="products-shop__card-title">{{ $product->name }}</h3>
                                    <p class="products-shop__card-desc">{{ Str::limit($product->description, 100) }}</p>
                                    <div class="products-shop__card-footer">
    <span class="text-xl font-bold text-gray-900">${{ number_format($product->price, 2) }}</span>
    <a href="{{ route('products.show', $product) }}"
        class="inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-700 focus:bg-blue-700 active:bg-blue-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
        Ver Detalles
    </a>
</div>
<div class="mt-2">
    @auth
        <form action="{{ route('cart.add') }}" method="POST" class="inline">
            @csrf
            <input type="hidden" name="product_id" value="{{ $product->id }}">
            <button type="submit" class="inline-flex items-center px-4 py-2 bg-green-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-green-700 focus:bg-green-700 active:bg-green-900 focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-offset-2 transition ease-in-out duration-150">
                Añadir a la tienda
            </button>
        </form>
    @else
        <a href="{{ route('register') }}" class="inline-flex items-center px-4 py-2 bg-yellow-500 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-yellow-600 focus:bg-yellow-600 active:bg-yellow-800 focus:outline-none focus:ring-2 focus:ring-yellow-400 focus:ring-offset-2 transition ease-in-out duration-150">
            Añadir a la tienda
        </a>
    @endauth
</div>
                                </div>
                            </div>
                        @empty
                            <div class="col-span-full text-center py-12">
                                <p class="text-gray-500">No se encontraron productos.</p>
                            </div>
                        @endforelse
                    </div>

                    <!-- Paginación -->
                    <div class="mt-8">
                        {{ $products->links() }}
                    </div>
                </main>
            </div>