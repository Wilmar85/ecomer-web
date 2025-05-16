@php
    $metaTitle = 'Inicio | InterEleticosf&A';
    $metaDescription = 'Bienvenido a InterEleticosf&A, tu tienda online de confianza para productos de calidad, ofertas exclusivas y envío ';
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
            {{-- <div class="home__banner-content">
                <h1 class="home__banner-title"> --}}
        <section class="home__section">
                    <video class="video-hosted" autoplay="" muted="" playsinline="" loop="" src="../mp4/02.mp4" style="width: 100%; height: auto;"></video>
        </section>
                {{--     Bienvenido a nuestra tienda en línea
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
            </div> --}}


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

    <x-cookie-banner />

</x-app-layout>
