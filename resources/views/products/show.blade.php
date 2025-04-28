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
        <div class="products-show__header-bar">
            <h2 class="products-show__header">
                {{ $product->name }}
            </h2>
            <div>
                @can('update', $product)
                    <a href="{{ route('admin.products.edit', $product) }}" class="products-show__edit-btn">Editar</a>
                @endcan
                <a href="{{ route('products.index') }}" class="products-show__back-link">
                    {{ __('Volver a Productos') }}
                </a>
            </div>
        </div>
    </x-slot>

    <div class="products-show">
        <div class="products-show__container">
            @if (session('success'))
                <div class="alert alert-success" role="alert">
                    <span>{{ session('success') }}</span>
                </div>
            @endif
            @if (session('error'))
                <div class="alert alert-danger" role="alert">
                    <span>{{ session('error') }}</span>
                </div>
            @endif

            <div class="products-show__gallery">
                @if ($product->images->isNotEmpty())
                    <div x-data="{ selectedImage: '{{ method_exists($product->images->first(), 'getImageUrlAttribute') ? $product->images->first()->image_url : asset('storage/' . $product->images->first()->image_path) }}' }">
                        <div class="products-show__img-wrapper">
                            <img :src="selectedImage" alt="{{ $product->name }}" class="products-show__img">
                        </div>
                        @if ($product->images->count() > 1)
                            <div class="products-show__thumbs">
                                @foreach ($product->images as $image)
                                    @php
                                        $imgUrl = method_exists($image, 'getImageUrlAttribute') ? $image->image_url : asset('storage/' . $image->image_path);
                                    @endphp
                                    <img src="{{ $imgUrl }}" alt="{{ $product->name }}"
                                        class="products-show__thumb"
                                        @click="selectedImage = '{{ $imgUrl }}'">
                                @endforeach
                            </div>
                        @endif
                    </div>
                @else
                    <div class="products-show__img--placeholder">
                        <span>Sin imagen</span>
                    </div>
                @endif
            </div>

            <div class="products-show__info">
                <h1 class="products-show__name">{{ $product->name }}</h1>
                <p class="products-show__meta">Categoría: {{ $product->category->name }}</p>
                <div class="products-show__price">
                    ${{ number_format($product->price, 2) }}
                </div>
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
