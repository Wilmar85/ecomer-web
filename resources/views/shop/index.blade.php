<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Tienda') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Filtros -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-6">
                <div class="p-6">
                    <form action="{{ route('shop.index') }}" method="GET"
                        class="space-y-4 md:space-y-0 md:flex md:gap-4">
                        <!-- Búsqueda por nombre -->
                        <div class="flex-1">
                            <label for="search" class="block text-sm font-medium text-gray-700 mb-1">Buscar por
                                nombre</label>
                            <input type="text" name="search" id="search" value="{{ request('search') }}"
                                class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50"
                                placeholder="Nombre del producto...">
                        </div>

                        <!-- Filtro por categoría -->
                        <div class="md:w-48">
                            <label for="category" class="block text-sm font-medium text-gray-700 mb-1">Categoría</label>
                            <select name="category" id="category"
                                class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50">
                                <option value="">Todas las categorías</option>
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}"
                                        {{ request('category') == $category->id ? 'selected' : '' }}>
                                        {{ $category->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Rango de precio -->
                        <div class="md:w-48">
                            <label for="price_min" class="block text-sm font-medium text-gray-700 mb-1">Precio
                                mínimo</label>
                            <input type="number" name="price_min" id="price_min" value="{{ request('price_min') }}"
                                class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50"
                                placeholder="0">
                        </div>

                        <div class="md:w-48">
                            <label for="price_max" class="block text-sm font-medium text-gray-700 mb-1">Precio
                                máximo</label>
                            <input type="number" name="price_max" id="price_max" value="{{ request('price_max') }}"
                                class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50"
                                placeholder="1000">
                        </div>

                        <!-- Botón de filtrar -->
                        <div class="md:self-end">
                            <button type="submit"
                                class="w-full md:w-auto bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                                Filtrar
                            </button>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Productos -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
                @forelse ($products as $product)
                    <div
                        class="bg-white overflow-hidden shadow-sm sm:rounded-lg hover:shadow-lg transition-shadow duration-300">
                        @if ($product->images->isNotEmpty())
                            <img src="{{ asset('storage/' . $product->images->first()->image_path) }}"
                                alt="{{ $product->name }}" class="w-full h-48 object-cover">
                        @endif
                        <div class="p-4">
                            <h3 class="text-lg font-semibold text-gray-800 mb-2">{{ $product->name }}</h3>
                            <p class="text-gray-600 text-sm mb-4">{{ Str::limit($product->description, 100) }}</p>
                            <div class="flex justify-between items-center">
                                <span
                                    class="text-lg font-bold text-blue-600">${{ number_format($product->price, 2) }}</span>
                                <a href="{{ route('products.show', $product) }}"
                                    class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600 transition-colors duration-300">
                                    Ver detalles
                                </a>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-span-full text-center py-12">
                        <p class="text-gray-500 text-lg">No se encontraron productos que coincidan con los filtros
                            seleccionados.</p>
                    </div>
                @endforelse
            </div>

            <!-- Paginación -->
            @if ($products->hasPages())
                <div class="mt-6">
                    {{ $products->links() }}
                </div>
            @endif
        </div>
    </div>
</x-app-layout>
