@props(['count' => 0])

<div
    class="cart-counter"
    data-count="{{ (int) $count }}"
>
    <a href="{{ route('cart.index') }}" class="cart-counter__link">
        <svg xmlns="http://www.w3.org/2000/svg" class="cart-counter__icon" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" />
        </svg>
        <span class="cart-counter__badge" style="display:none">
            <span></span>
        </span>
    </a>
</div>
<script>
// Laravel.isLoggedIn: true si el usuario está autenticado
window.Laravel = window.Laravel || {};
window.Laravel.isLoggedIn = {{ auth()->check() ? 'true' : 'false' }};
</script>