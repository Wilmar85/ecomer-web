// JS vainilla para el modal rápido y el formulario de agregar al carrito en product-card

document.addEventListener('DOMContentLoaded', function () {
    // Modal rápido
    document.querySelectorAll('.product-card').forEach(function(card) {
        const quickviewBtn = card.querySelector('.product-card__quickview-btn');
        const quickviewModal = card.querySelector('.product-card__quickview-modal');
        const quickviewClose = card.querySelector('.product-card__quickview-close');
        if (quickviewBtn && quickviewModal) {
            quickviewBtn.addEventListener('click', function(e) {
                e.preventDefault();
                quickviewModal.style.display = 'block';
            });
            // Cerrar modal al hacer click fuera del contenido
            quickviewModal.addEventListener('mousedown', function(e) {
                if (e.target === quickviewModal) quickviewModal.style.display = 'none';
            });
            // Cerrar modal con el botón
            if (quickviewClose) {
                quickviewClose.addEventListener('click', function() {
                    quickviewModal.style.display = 'none';
                });
            }
        }
        // Formulario agregar al carrito por AJAX
        card.querySelectorAll('form.product-card__action').forEach(function(form) {
            form.addEventListener('submit', function(e) {
                e.preventDefault();
                let data = new FormData(form);
                fetch(form.action, {
                    method: 'POST',
                    headers: { 'X-Requested-With': 'XMLHttpRequest', 'X-CSRF-TOKEN': data.get('_token') },
                    body: data
                }).then(res => {
                    if(res.redirected) { window.location.href = res.url; return; }
                    if(res.ok) {
                        res.clone().json().then(data => {
                            if(typeof data.count !== 'undefined') {
                                window.dispatchEvent(new CustomEvent('cart-updated', { detail: { count: data.count } }));
                                if(window.Laravel && window.Laravel.updateCartCount) window.Laravel.updateCartCount(data.count);
                            } else {
                                window.dispatchEvent(new CustomEvent('cart-updated'));
                            }
                        });
                    }
                    return res.json();
                }).catch(() => {});
            });
        });
    });
});
