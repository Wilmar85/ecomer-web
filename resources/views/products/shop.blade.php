<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Barra de búsqueda -->
            <div class="mb-8">
                <form action="{{ route('shop.index') }}" method="GET" class="flex gap-4">
                    <div class="flex-1">
                        <input type="text" name="search" value="{{ request('search') }}" 
                            class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500"
                            placeholder="Buscar productos...">
                    </div>
                    <div class="flex-none">
                        <button type="submit" 
                            class="inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-700 focus:bg-blue-700 active:bg-blue-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                            Buscar
                        </button>
                    </div>
                </form>
            </div>

            <!-- Filtros y Categorías -->
            <div class="mb-8 flex flex-wrap gap-4">
                <a href="{{ route('shop.index') }}" 
                    class="px-4 py-2 rounded-full {{ !request('category') ? 'bg-blue-600 text-white' : 'bg-gray-200 text-gray-700' }} hover:bg-blue-700 hover:text-white transition-colors">
                    Todos
                </a>
                @foreach ($categories as $category)
                    <a href="{{ route('shop.index', ['category' => $category->slug]) }}" 
                        class="px-4 py-2 rounded-full {{ request('category') == $category->slug ? 'bg-blue-600 text-white' : 'bg-gray-200 text-gray-700' }} hover:bg-blue-700 hover:text-white transition-colors">
                        {{ $category->name }}
                    </a>
                @endforeach
            </div>

            <!-- Lista de Productos -->
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                @forelse ($products as $product)
                    <div class="bg-white rounded-lg shadow-md overflow-hidden group">
                        @if ($product->images->isNotEmpty())
                            <div class="aspect-w-3 aspect-h-2">
                                <img src="{{ asset('storage/' . $product->images->first()->path) }}" 
                                    alt="{{ $product->name }}" 
                                    class="w-full h-48 object-cover object-center group-hover:opacity-75">
                            </div>
                        @endif
                        <div class="p-4">
                            <h3 class="text-lg font-semibold text-gray-800 mb-2">{{ $product->name }}</h3>
                            <p class="text-gray-600 text-sm mb-4">{{ Str::limit($product->description, 100) }}</p>
                            <div class="flex items-center justify-between">
                                <span class="text-xl font-bold text-gray-900">${{ number_format($product->price, 2) }}</span>
                                <a href="{{ route('products.show', $product) }}" 
                                    class="inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-700 focus:bg-blue-700 active:bg-blue-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                                    Ver Detalles
                                </a>
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
        </div>
    </div>
</x-app-layout>