@php
    $metaTitle = $category->name . ' | E-commerce Web';
    $metaDescription = 'Encuentra los mejores productos en la categoría ' . $category->name;
    $metaKeywords = $category->name . ', productos, ecommerce, tienda';
    $ogTitle = $category->name;
    $ogDescription = 'Explora productos destacados de la categoría ' . $category->name;
    $ogImage = asset('images/default-og.png');
    $canonical = url()->current();
@endphp

@push('jsonld')
<script type="application/ld+json">
{
  "@context": "https://schema.org",
  "@type": "CollectionPage",
  "name": "{{ $category->name }}",
  "description": "Encuentra los mejores productos en la categoría {{ $category->name }}",
  "mainEntity": {
    "@type": "ItemList",
    "numberOfItems": {{ $products->count() }},
    "itemListElement": [
      @foreach($products as $index => $product)
        {
          "@type": "Product",
          "position": {{ $index + 1 }},
          "name": "{{ $product->name }}",
          "url": "{{ route('products.show', $product) }}"
        }@if(!$loop->last),@endif
      @endforeach
    ]
  }
}
</script>
@endpush

<x-app-layout>
    <div class="categories-show__section">
        <div class="categories-show__container">
            <div class="categories-show__header">
                <h1 class="categories-show__title">{{ $category->name }}</h1>
                @if ($category->description)
                    <p class="categories-show__desc">{{ $category->description }}</p>
                @endif
            </div>

            <div class="categories-show__products">
                @forelse ($products as $product)
    <x-product-card :product="$product" />
@empty
    <div class="categories-show__empty">No hay productos en esta categoría.</div>
@endforelse
            </div>

            <div class="categories-show__pagination">
                {{ $products->links() }}
            </div>
        </div>
    </div>
</x-app-layout>
