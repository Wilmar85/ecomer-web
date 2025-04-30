@props(['product'])

<div class="product-card">
    @if ($product->images->isNotEmpty())
        @php
            $imgUrl = method_exists($product->images->first(), 'getImageUrlAttribute') ? $product->images->first()->image_url : (property_exists($product->images->first(), 'image_path') ? asset('storage/' . $product->images->first()->image_path) : asset('storage/' . $product->images->first()->path));
        @endphp
        <a href="{{ route('products.show', $product) }}" class="product-card__img-link">
            <img src="{{ $imgUrl }}" alt="{{ $product->name }}" class="product-card__img" loading="lazy">
        </a>

        <button class="product-card__quickview-btn">
            <svg xmlns="http://www.w3.org/2000/svg" class="product-card__quickview-icon" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0zm6 0c0 5-7 9-7 9s-7-4-7-9a7 7 0 0114 0z" />
            </svg>
        </button>
        <div class="product-card__quickview-modal" style="display:none;">
            <div class="product-card__quickview-content">
                <h2 class="product-card__quickview-title">{{ $product->name }}</h2>
                <p class="product-card__quickview-desc">{{ $product->description }}</p>
                <button class="product-card__quickview-close">Cerrar</button>
            </div>
        </div>
    @endif
    <div class="product-card__body">
        <div>
            <a href="{{ route('products.show', $product) }}" class="product-card__name">{{ $product->name }}</a>
            <p class="product-card__desc">{{ Str::limit($product->description, 100) }}</p>
        </div>
        <div>
            <span class="product-card__price">${{ number_format($product->price, 2) }}</span>
        </div>
        <div class="product-card__btns">
            <a href="{{ route('products.show', $product) }}" class="product-card__action" title="Ver detalles">
                <svg xmlns="http://www.w3.org/2000/svg" class="product-card__action-icon" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0zm6 0c0 5-7 9-7 9s-7-4-7-9a7 7 0 0114 0z" />
                </svg>
            </a>
            @auth
                <form action="{{ route('cart.add') }}" method="POST" class="product-card__action">
                    @csrf
                    <input type="hidden" name="product_id" value="{{ $product->id }}">
                    <input type="hidden" name="quantity" value="1">
                    <button type="submit" class="product-card__action product-card__action--add">
                        <svg xmlns="http://www.w3.org/2000/svg" class="product-card__action-icon" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13l-1.35 2.7A2 2 0 007.48 19h8.94a2 2 0 001.83-1.23L21 13M7 13V6a1 1 0 011-1h9a1 1 0 011 1v7" />
                        </svg>
                    </button>
                </form>
            @else
                <a href="{{ route('login') }}" class="product-card__action product-card__action--add">
                    <svg xmlns="http://www.w3.org/2000/svg" class="product-card__action-icon" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13l-1.35 2.7A2 2 0 007.48 19h8.94a2 2 0 001.83-1.23L21 13M7 13V6a1 1 0 011-1h9a1 1 0 011 1v7" />
                    </svg>
                </a>
            @endauth
        </div>
    </div>
</div>
