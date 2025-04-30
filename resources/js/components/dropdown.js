// JS vainilla para dropdown

document.addEventListener('DOMContentLoaded', function () {
    document.querySelectorAll('.dropdown').forEach(function(dropdown) {
        let open = false;
        const trigger = dropdown.querySelector('.dropdown__trigger');
        const content = dropdown.querySelector('.dropdown__content');
        const mobileBtn = dropdown.querySelector('.dropdown__mobile-toggle');

        // Mostrar/Ocultar
        function showDropdown() {
            content.style.display = '';
            content.classList.add('dropdown--open');
            open = true;
        }
        function hideDropdown() {
            content.style.display = 'none';
            content.classList.remove('dropdown--open');
            open = false;
        }
        function toggleDropdown() {
            if (open) {
                hideDropdown();
            } else {
                showDropdown();
            }
        }

        // Click en trigger
        if (trigger) {
            trigger.addEventListener('click', function(e) {
                e.stopPropagation();
                toggleDropdown();
            });
        }
        // Click en botón mobile
        if (mobileBtn) {
            mobileBtn.addEventListener('click', function(e) {
                e.stopPropagation();
                toggleDropdown();
            });
        }
        // Click fuera
        document.addEventListener('click', function(e) {
            if (!dropdown.contains(e.target)) {
                hideDropdown();
            }
        });
        // Click en el contenido cierra
        if (content) {
            content.addEventListener('click', function() {
                hideDropdown();
            });
        }
        // Inicialmente oculto
        hideDropdown();
    });
});
