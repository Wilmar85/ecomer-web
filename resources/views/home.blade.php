@php
    $metaTitle = 'Inicio | E-commerce Web';
    $metaDescription = 'Bienvenido a la mejor tienda online. Descubre productos de calidad, ofertas y envío gratis en compras mayores a $500.';
    $metaKeywords = 'inicio, ecommerce, ofertas, productos, tienda online';
    $ogTitle = 'Bienvenido a E-commerce Web';
    $ogDescription = 'Explora nuestra tienda online y encuentra productos increíbles a precios bajos.';
    $ogImage = asset('images/default-og.png');
    $canonical = url('/');
@endphp

@push('jsonld')
<script type="application/ld+json">
{
  "@context": "https://schema.org",
  "@type": "WebSite",
  "name": "E-commerce Web",
  "url": "{{ url('/') }}"
}
</script>
@endpush

<x-app-layout>
    <div class="py-12">
        <!-- Banner Informativo -->
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 mb-12">
            <div class="bg-gradient-to-r from-blue-600 to-indigo-700 rounded-lg shadow-xl overflow-hidden">
                <div class="px-6 py-12 md:px-12 text-center md:text-left">
                    <div class="md:flex md:items-center md:justify-between">
                        <div class="md:w-2/3">
                            <h1 class="text-3xl font-extrabold text-white sm:text-4xl">
                                Bienvenido a nuestra tienda en línea
                            </h1>
                            <p class="mt-4 text-lg text-blue-100">
                                Descubre nuestra selección de productos de alta calidad a los mejores precios.
                                ¡Envío gratis en compras mayores a $500!
                            </p>
                            <div class="mt-8">
                                <a href="{{ route('shop.index') }}"
                                    class="inline-flex items-center px-6 py-3 border border-transparent text-base font-medium rounded-md text-blue-700 bg-white hover:bg-blue-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                                    Ir a la Tienda
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Categorías Destacadas -->
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 mb-12">
            <h2 class="text-2xl font-bold text-gray-900 mb-6">Categorías Destacadas</h2>
            <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
                @foreach ($categories as $category)
                    <a href="{{ route('categories.show', $category) }}" class="group">
                        <div
                            class="bg-white rounded-lg shadow-md overflow-hidden transition-transform duration-200 transform hover:scale-105">
                            <div class="p-4">
                                <h3 class="text-lg font-semibold text-gray-900 group-hover:text-blue-600">
                                    {{ $category->name }}</h3>
                                <p class="text-sm text-gray-600">{{ $category->products_count }} productos</p>
                            </div>
                        </div>
                    </a>
                @endforeach
            </div>
        </div>

        <!-- Productos Destacados -->
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <h2 class="text-2xl font-bold text-gray-900 mb-6">Productos Destacados</h2>
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                @foreach ($products as $product)
                    <div
                        class="bg-white rounded-lg shadow-md overflow-hidden transition-transform duration-200 transform hover:scale-105">
                        @if ($product->images->isNotEmpty())
                            <img src="{{ asset('storage/' . $product->images->first()->path) }}"
                                alt="{{ $product->name }}" class="w-full h-48 object-cover">
                        @endif
                        <div class="p-4">
                            <h3 class="text-lg font-semibold text-gray-900">{{ $product->name }}</h3>
                            <p class="text-gray-600 text-sm mb-2">{{ Str::limit($product->description, 100) }}</p>
                            <div class="flex justify-between items-center">
                                <span class="text-blue-600 font-bold">${{ number_format($product->price, 2) }}</span>
                                <a href="{{ route('products.show', $product) }}"
                                    class="text-blue-600 hover:text-blue-800 font-medium">Ver detalles</a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</x-app-layout>
