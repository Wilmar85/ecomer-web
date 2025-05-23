@php
    $metaTitle = 'Inicio | InterEleticosf&A';
    $metaDescription = 'Bienvenido a InterEleticosf&A, tu tienda online de confianza para productos de calidad, ofertas exclusivas y envío gratis en compras mayores a $500.';
    $metaKeywords = 'inicio, ecommerce, ofertas, productos, tienda online, InterEleticosfA';
    $ogTitle = 'Bienvenido a InterEleticosf&A';
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

        <!-- Productos vistos recientemente -->
        @if(isset($visitedProducts) && $visitedProducts->isNotEmpty())
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 mb-12">
            <h2 class="text-2xl font-bold text-gray-900 mb-6">Productos que has visto recientemente</h2>
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                @foreach ($visitedProducts as $product)
    <x-product-card :product="$product" />
@endforeach
            </div>
        </div>
        @endif

        <!-- Productos Destacados -->
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <h2 class="text-2xl font-bold text-gray-900 mb-6">Productos Destacados</h2>
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                @foreach ($products as $product)
                    <x-product-card :product="$product" />
                @endforeach
            </div>
        </div>

        <!-- Marcas de Clientes -->
        <x-brand-section :brands="[
            'MERCURY', 'TITANIUM', 'ZAFIRO', 'ILUMAX', 'ECOLITE', 'EXCELITE', 'INTERLED', 'DEXON', 'BRIOLIGH', 'ROYAL', 'LUMEK',
            'TITANIUM', 'DIXTON', 'BAYTER', 'SPARKLED', 'KARLUX', 'FELGOLUX', 'NEW LIGHT', 'DIGITAL LIGHT', 'SICOLUX', 'ACRILED', 'MARWA'
        ]" />
    </div>
    <!-- Banner de Cookies (Ley Colombiana) -->
    <div x-data="{ showCookieBanner: localStorage.getItem('cookieAccepted') !== '1' && localStorage.getItem('cookieAccepted') !== '0' }" x-show="showCookieBanner" class="fixed bottom-0 left-0 w-full bg-gray-900 text-white p-4 z-50 flex flex-col md:flex-row items-center justify-between gap-2">
        <span>
            Usamos cookies para mejorar tu experiencia y cumplir la <b>Ley 1581 de 2012</b> y <b>Decreto 1377 de 2013</b> de Colombia. Consulta nuestra <a href="{{ url('/cookies') }}" class="underline text-blue-300">Política de Cookies</a>.
        </span>
        <div class="flex gap-2 mt-2 md:mt-0">
            <button @click="localStorage.setItem('cookieAccepted', '1'); showCookieBanner = false" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                Aceptar
            </button>
            <button @click="localStorage.setItem('cookieAccepted', '0'); showCookieBanner = false" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">
                Rechazar
            </button>
        </div>
    </div>

</x-app-layout>
