// JS vainilla para mostrar/ocultar el botón de scroll-to-top y desplazar la página arriba

document.addEventListener('DOMContentLoaded', function () {
    // Para todos los botones de scroll-to-top
    document.querySelectorAll('[data-scroll-to-top-btn]').forEach(function(btn){
        const showBtn = () => {
            if(window.scrollY > 100) {
                btn.style.display = '';
            } else {
                btn.style.display = 'none';
            }
        };
        showBtn();
        window.addEventListener('scroll', showBtn);
        btn.addEventListener('click', function(e){
            e.preventDefault();
            window.scrollTo({top: 0, behavior: 'smooth'});
        });
    });
});
