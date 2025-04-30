// JS vainilla para cerrar modales desde botones secundarios

document.addEventListener('DOMContentLoaded', function () {
    document.querySelectorAll('[data-close-modal-btn]').forEach(function(btn) {
        btn.addEventListener('click', function(e) {
            e.preventDefault();
            const event = new CustomEvent('close');
            window.dispatchEvent(event);
        });
    });
});
