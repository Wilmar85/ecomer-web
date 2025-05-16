// JS vainilla para mostrar/ocultar el botón de scroll-to-top y desplazar la página arriba

document.addEventListener('DOMContentLoaded', function() {
    var btn = document.getElementById('scrollToTopBtn');
    var container = document.getElementById('scrollToTopBtnContainer');
    function toggleBtn() {
        if (window.scrollY > 120) {
            container.style.display = 'block';
        } else {
            container.style.display = 'none';
        }
    }
    if (btn && container) {
        btn.addEventListener('click', function() {
            window.scrollTo({top: 0, behavior: 'smooth'});
        });
        window.addEventListener('scroll', toggleBtn);
        toggleBtn(); // Inicializar estado al cargar
    }
});