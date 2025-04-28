<x-app-layout>
    <div class="welcome">
    <!-- Banner Informativo -->
    <div class="welcome__banner">
        <div class="welcome__banner-content">
            <div class="welcome__banner-flex">
                <div class="welcome__banner-main">
                    <h1 class="welcome__banner-title">
                                Bienvenido a nuestra tienda en línea
                            </h1>
                            <p class="welcome__banner-desc">
                                Descubre nuestra selección de productos de alta calidad a los mejores precios.
                                ¡Envío gratis en compras mayores a $500!
                            </p>
                            <div class="welcome__banner-cta">
                                <a href="{{ route('shop.index') }}"
                                    class="welcome__banner-btn">
                                    Ir a la Tienda
                                </a>
                            </div>
                        </div>
                        <div class="welcome__banner-image">
                            <svg class="welcome__banner-svg" fill="currentColor" viewBox="0 0 24 24">
                                <path
                                    d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm0 18c-4.41 0-8-3.59-8-8s3.59-8 8-8 8 3.59 8 8-3.59 8-8 8zm-1-13h2v6h-2zm0 8h2v2h-2z" />
                            </svg>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="welcome__main">
        <!-- Sección de Categorías -->
        <div class="category-list">
            <h2 class="category-list__title">Categorías</h2>
            <div class="category-list__grid">
                @foreach ($categories as $category)
                    <a href="{{ route('categories.show', $category) }}" class="category-card">
                        <div class="category-card__content">
                            <h3 class="category-card__title">
                                {{ $category->name }}</h3>
                            <p class="category-card__count">{{ $category->products_count }} productos</p>
                        </div>
                    </a>
                @endforeach
            </div>
        </div>

        <!-- Sección de Productos Destacados -->
        <div>
            <h2 class="featured-list__title">Productos Destacados</h2>
            <div class="featured-list__grid">
                @foreach ($products as $product)
                    <div class="featured-card">
                        @if ($product->images->isNotEmpty())
                            <div class="featured-card__imgwrap">
                                <img src="{{ asset('storage/' . $product->images->first()->path) }}"
                                    alt="{{ $product->name }}"
                                    class="featured-card__img">
                            </div>
                        @endif
                        <div class="featured-card__content">
                            <h3 class="featured-card__title">{{ $product->name }}</h3>
                            <p class="featured-card__desc">{{ Str::limit($product->description, 100) }}</p>
                            <div class="featured-card__footer">
                                <span
                                    class="featured-card__price">${{ number_format($product->price, 2) }}</span>
                                <a href="{{ route('products.show', $product) }}"
                                    class="featured-card__btn">
                                    Ver Detalles
                                </a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</x-app-layout>
