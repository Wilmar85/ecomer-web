@php
    $metaTitle = $product->name . ' | E-commerce Web';
    $metaDescription = $product->short_description ?? Str::limit(strip_tags($product->description), 150);
    $metaKeywords = $product->name . ', ' . ($product->category->name ?? '') . ', comprar, ecommerce';
    $ogTitle = $product->name;
    $ogDescription = $product->short_description ?? Str::limit(strip_tags($product->description), 150);
    $ogImage = $product->images->isNotEmpty() ? asset('storage/' . $product->images->first()->path) : asset('images/default-og.png');
    $canonical = url()->current();
@endphp

@push('jsonld')
<script type="application/ld+json">
{
  "@context": "https://schema.org",
  "@type": "Product",
  "name": "{{ $product->name }}",
  "image": [
    @if($product->images->isNotEmpty())
      @foreach($product->images as $img)"{{ asset('storage/' . $img->path) }}"@if(!$loop->last),@endif @endforeach
    @else
      "{{ asset('images/default-og.png') }}"
    @endif
  ],
  "description": "{{ $product->short_description ?? Str::limit(strip_tags($product->description), 150) }}",
  "sku": "{{ $product->sku ?? $product->id }}",
  "brand": {
    "@type": "Brand",
    "name": "{{ $product->brand->name ?? 'Marca genérica' }}"
  },
  "offers": {
    "@type": "Offer",
    "priceCurrency": "MXN",
    "price": "{{ $product->price }}",
    "availability": "https://schema.org/{{ $product->stock > 0 ? 'InStock' : 'OutOfStock' }}"
  }
}
</script>
@endpush

<x-app-layout>
    @push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            fetch("{{ route('preferences.visited', ['productId' => $product->id]) }}", {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    'Accept': 'application/json'
                }
            });
        });
    </script>
    @endpush
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ $product->name }}
            </h2>
            <div class="flex gap-2 items-center">
                @can('update', $product)
                    <a href="{{ route('admin.products.edit', $product) }}" class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">Editar</a>
                @endcan
                <a href="{{ route('products.index') }}" class="text-blue-500 hover:text-blue-700">
                    {{ __('Volver a Productos') }}
                </a>
            </div>
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

                    @if (session('error'))
                        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4"
                            role="alert">
                            <span class="block sm:inline">{{ session('error') }}</span>
                        </div>
                    @endif

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                        <div class="space-y-4">
                            @if ($product->images->isNotEmpty())
    <div x-data="{ selectedImage: '{{ method_exists($product->images->first(), 'getImageUrlAttribute') ? $product->images->first()->image_url : asset('storage/' . $product->images->first()->image_path) }}' }">
        <div class="relative h-96 overflow-hidden rounded-lg">
            <img :src="selectedImage" alt="{{ $product->name }}" class="w-full h-full object-cover transition-all duration-200">
        </div>
        @if ($product->images->count() > 1)
            <div class="grid grid-cols-4 gap-2 mt-2">
                @foreach ($product->images as $image)
                    @php
                        $imgUrl = method_exists($image, 'getImageUrlAttribute') ? $image->image_url : asset('storage/' . $image->image_path);
                    @endphp
                    <img src="{{ $imgUrl }}" alt="{{ $product->name }}"
                        class="w-full h-24 object-cover rounded cursor-pointer hover:opacity-75 border-2 border-transparent hover:border-blue-400"
                        @click="selectedImage = '{{ $imgUrl }}'">
                @endforeach
            </div>
        @endif
    </div>
                            @else
                                <div class="h-96 bg-gray-200 flex items-center justify-center rounded-lg">
                                    <span class="text-gray-500">Sin imagen</span>
                                </div>
                            @endif
                        </div>

                        <div class="space-y-6">
                            <div>
                                <h1 class="text-3xl font-bold text-gray-900">{{ $product->name }}</h1>
                                <p class="text-sm text-gray-500">Categoría: {{ $product->category->name }}</p>
                            </div>

                            <div class="text-2xl font-bold text-gray-900">
                                ${{ number_format($product->price, 2) }}
                            </div>

                            <div class="prose max-w-none">
                                {{ $product->description }}
                            </div>

                            <div class="text-sm text-gray-600">
                                Stock disponible: {{ $product->stock }}
                            </div>

                            @auth
                                <form action="{{ route('cart.add') }}" method="POST" class="space-y-4">
                                    @csrf
                                    <input type="hidden" name="product_id" value="{{ $product->id }}">

                                    <div>
                                        <label for="quantity"
                                            class="block text-sm font-medium text-gray-700">Cantidad</label>
                                        <input type="number" name="quantity" id="quantity" min="1"
                                            max="{{ $product->stock }}" value="1"
                                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                                    </div>

                                    <button type="submit"
                                        class="w-full bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded"
                                        {{ $product->stock < 1 ? 'disabled' : '' }}>
                                        {{ $product->stock < 1 ? 'Sin stock' : 'Agregar al carrito' }}
                                    </button>
                                </form>
                            @else
                                <div class="text-center py-4">
                                    <a href="{{ route('login') }}" class="text-blue-500 hover:text-blue-700">
                                        Inicia sesión para comprar
                                    </a>
                                </div>
                            @endauth
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
