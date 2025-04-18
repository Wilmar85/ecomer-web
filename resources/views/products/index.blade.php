<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Productos') }}
            </h2>
            @if (Auth::user()?->isAdmin())
                <a href="{{ route('products.create') }}"
                    class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                    {{ __('Crear Producto') }}
                </a>
            @endif
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    @if (session('success'))
                        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4"
                            role="alert">
                            <span class="block sm:inline">{{ session('success') }}</span>
                        </div>
                    @endif

                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
                        @foreach ($products as $product)
                            <div class="bg-white rounded-lg shadow-md overflow-hidden">
                                @if ($product->images->isNotEmpty())
                                    <img src="{{ $product->images->first()?->image_url ?? '' }}"
                                        alt="{{ $product->name }}" class="w-full h-48 object-cover">
                                @else
                                    <div class="w-full h-48 bg-gray-200 flex items-center justify-center">
                                        <span class="text-gray-500">Sin imagen</span>
                                    </div>
                                @endif

                                <div class="p-4">
                                    <h3 class="text-lg font-semibold mb-2">{{ $product->name }}</h3>
                                    <p class="text-gray-600 text-sm mb-2">{{ Str::limit($product->description, 100) }}
                                    </p>
                                    <p class="text-gray-800 font-bold mb-2">${{ number_format($product->price, 2) }}</p>
                                    <p class="text-sm text-gray-600 mb-4">Stock: {{ $product->stock }}</p>

                                    <div class="flex justify-between items-center">
                                        <a href="{{ route('products.show', $product) }}"
                                            class="text-blue-500 hover:text-blue-700">
                                            Ver detalles
                                        </a>

                                        @if (Auth::user()?->isAdmin())
                                            <div class="flex space-x-2">
                                                <a href="{{ route('products.edit', $product) }}"
                                                    class="text-yellow-500 hover:text-yellow-700">
                                                    Editar
                                                </a>

                                                <form action="{{ route('products.destroy', $product) }}" method="POST"
                                                    class="inline"
                                                    onsubmit="return confirm('¿Estás seguro de que deseas eliminar este producto?');">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="text-red-500 hover:text-red-700">
                                                        Eliminar
                                                    </button>
                                                </form>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <div class="mt-6">
                        {{ $products->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
