// JS vainilla para modal

document.addEventListener('DOMContentLoaded', function () {
    document.querySelectorAll('.modal').forEach(function(modal) {
        let show = modal.style.display !== 'none';
        const overlay = modal.querySelector('.modal__overlay');
        const closeBtns = modal.querySelectorAll('[data-modal-close]');

        // Funciones para focusables
        function focusables() {
            let selector = 'a, button, input:not([type="hidden"]), textarea, select, details, [tabindex]:not([tabindex="-1"])';
            return Array.from(modal.querySelectorAll(selector)).filter(el => !el.hasAttribute('disabled'));
        }
        function firstFocusable() { return focusables()[0]; }
        function lastFocusable() { return focusables().slice(-1)[0]; }
        function nextFocusable() {
            let idx = focusables().indexOf(document.activeElement);
            return focusables()[(idx + 1) % focusables().length] || firstFocusable();
        }
        function prevFocusable() {
            let idx = focusables().indexOf(document.activeElement);
            return focusables()[idx > 0 ? idx - 1 : focusables().length - 1] || lastFocusable();
        }

        // Mostrar/Ocultar modal
        function showModal() {
            modal.style.display = 'block';
            document.body.classList.add('overflow-y-hidden');
            show = true;
            setTimeout(() => { if (firstFocusable()) firstFocusable().focus(); }, 100);
        }
        function hideModal() {
            modal.style.display = 'none';
            document.body.classList.remove('overflow-y-hidden');
            show = false;
        }

        // Overlay click
        if (overlay) {
            overlay.addEventListener('click', function(e) {
                if (e.target === overlay) hideModal();
            });
        }
        // Botones de cerrar
        closeBtns.forEach(btn => {
            btn.addEventListener('click', hideModal);
        });
        // Escape key
        document.addEventListener('keydown', function(e) {
            if (show && e.key === 'Escape') hideModal();
            // Tab trap
            if (show && e.key === 'Tab') {
                if (e.shiftKey) {
                    prevFocusable().focus();
                } else {
                    nextFocusable().focus();
                }
                e.preventDefault();
            }
        });
        // Abrir modal por evento personalizado
        window.addEventListener('open-modal', function(evt) {
            if (evt.detail === modal.getAttribute('data-modal-name')) showModal();
        });
        // Cerrar modal por evento personalizado
        window.addEventListener('close-modal', function(evt) {
            if (evt.detail === modal.getAttribute('data-modal-name')) hideModal();
        });
        // Inicial
        if (show) showModal(); else hideModal();
    });
});
