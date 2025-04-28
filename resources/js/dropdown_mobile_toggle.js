// dropdown_mobile_toggle.js
// Permite abrir/cerrar el dropdown en mobile añadiendo/removiendo la clase .dropdown--mobile-visible

document.addEventListener('DOMContentLoaded', function () {
    // Selecciona todos los dropdowns que quieras controlar
    const dropdowns = document.querySelectorAll('.dropdown');
    
    dropdowns.forEach(function(dropdown) {
        // Busca un botón para abrir/cerrar dentro del dropdown
        const toggleBtn = dropdown.querySelector('.dropdown__mobile-toggle');
        if (!toggleBtn) return;

        toggleBtn.addEventListener('click', function(e) {
            e.preventDefault();
            dropdown.classList.toggle('dropdown--mobile-visible');
        });
    });
});
