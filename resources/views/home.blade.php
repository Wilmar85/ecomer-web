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
    <div class="home">
        <!-- Banner Informativo -->
        <section class="home__section home__banner">
            <div class="home__banner-content">
                <h1 class="home__banner-title">
                    Bienvenido a nuestra tienda en línea
                </h1>
                <p class="home__banner-desc">
                    Descubre nuestra selección de productos de alta calidad a los mejores precios.
                    ¡Envío gratis en compras mayores a $500!
                </p>
                <div>
                    <a href="{{ route('shop.index') }}" class="home__banner-cta">
                        Ir a la Tienda
                    </a>
                </div>
            </div>
        </section>


        <!-- Categorías Destacadas -->
        <section class="home__section home__categories">
            <h2 class="home__categories-title">Categorías Destacadas</h2>
            <div class="home__categories-grid">
                @foreach ($categories as $category)
                    <a href="{{ route('categories.show', $category) }}" class="home__categories-card">
                        <div>
                            <h3 class="home__categories-card-title">{{ $category->name }}</h3>
                            <p class="home__categories-card-count">{{ $category->products_count }} productos</p>
                        </div>
                    </a>
                @endforeach
            </div>
        </section>

        <!-- Productos vistos recientemente -->
        @if(isset($visitedProducts) && $visitedProducts->isNotEmpty())
        <div class="home__recent">
            <h2 class="home__recent-title">Productos que has visto recientemente</h2>
            <div class="home__recent-grid">
                @foreach ($visitedProducts as $product)
    <x-product-card :product="$product" />
@endforeach
            </div>
        </div>
        @endif

        <!-- Productos Destacados -->
        <div class="home__products">
            <h2 class="home__products-title">Productos Destacados</h2>
            <div class="home__recent-grid">
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
