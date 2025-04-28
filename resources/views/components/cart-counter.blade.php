@props(['count' => 0])

<div
    x-data="{
        cartCount: {{ (int) $count }},
        fetchCartCount() {
            fetch('/api/cart/count', {
                headers: { 'X-Requested-With': 'XMLHttpRequest' },
                credentials: 'same-origin'
            })
                .then(res => res.ok ? res.json() : { count: 0 })
                .then(data => { if (typeof data.count !== 'undefined') this.cartCount = data.count })
                .catch(() => {});
        }
    }"
    x-init="if (window.Laravel && window.Laravel.isLoggedIn) {
        fetchCartCount();
        setInterval(fetchCartCount, 10000);
        window.addEventListener('cart-updated', e => {
            if(e.detail && typeof e.detail.count !== 'undefined') this.cartCount = e.detail.count;
            else fetchCartCount();
        });
        window.Laravel.updateCartCount = count => { this.cartCount = count; };
    }"
    class="cart-counter"
>
    <a href="{{ route('cart.index') }}" class="cart-counter__link">
        <svg xmlns="http://www.w3.org/2000/svg" class="cart-counter__icon" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" />
        </svg>
        <template x-if="cartCount > 0">
            <span class="cart-counter__badge">
                <span x-text="cartCount"></span>
            </span>
        </template>
    </a>
</div>
<script>
// Laravel.isLoggedIn: true si el usuario está autenticado
window.Laravel = window.Laravel || {};
window.Laravel.isLoggedIn = {{ auth()->check() ? 'true' : 'false' }};
</script>