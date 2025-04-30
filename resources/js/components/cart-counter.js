// JS vainilla para el contador del carrito

document.addEventListener('DOMContentLoaded', function () {
    document.querySelectorAll('.cart-counter').forEach(function(counter) {
        let cartCount = parseInt(counter.getAttribute('data-count'), 10) || 0;
        const badge = counter.querySelector('.cart-counter__badge');
        const badgeText = badge ? badge.querySelector('span') : null;

        function updateBadge() {
            if (cartCount > 0) {
                if (badge) {
                    badge.style.display = '';
                    if (badgeText) badgeText.textContent = cartCount;
                }
            } else {
                if (badge) badge.style.display = 'none';
            }
        }
        function fetchCartCount() {
            fetch('/api/cart/count', {
                headers: { 'X-Requested-With': 'XMLHttpRequest' },
                credentials: 'same-origin'
            })
                .then(res => res.ok ? res.json() : { count: 0 })
                .then(data => { if (typeof data.count !== 'undefined') { cartCount = data.count; updateBadge(); } })
                .catch(() => {});
        }
        // Inicial
        updateBadge();
        // Si está logueado
        if (window.Laravel && window.Laravel.isLoggedIn) {
            fetchCartCount();
            setInterval(fetchCartCount, 10000);
            window.addEventListener('cart-updated', function(e) {
                if(e.detail && typeof e.detail.count !== 'undefined') {
                    cartCount = e.detail.count;
                    updateBadge();
                } else {
                    fetchCartCount();
                }
            });
            window.Laravel.updateCartCount = function(count) {
                cartCount = count;
                updateBadge();
            };
        }
    });
});
