// menu.js - Lógica para menú responsive BEM

document.addEventListener('DOMContentLoaded', function () {
    const burger = document.querySelector('.menu__burger');
    const mobileMenu = document.querySelector('.menu__links-mobile');
    const overlay = document.querySelector('.menu__overlay');

    if (!burger || !mobileMenu) return;

    // Toggle menú mobile
    burger.addEventListener('click', function () {
        const isOpen = mobileMenu.classList.contains('menu__links-mobile--open');
        mobileMenu.classList.toggle('menu__links-mobile--open');
        if (overlay) overlay.style.display = isOpen ? 'none' : 'block';
        document.body.style.overflow = isOpen ? '' : 'hidden';
    });

    // Cerrar menú mobile al hacer click en overlay
    if (overlay) {
        overlay.addEventListener('click', function () {
            mobileMenu.classList.remove('menu__links-mobile--open');
            overlay.style.display = 'none';
            document.body.style.overflow = '';
        });
    }

    // Cerrar menú mobile al cambiar a desktop
    window.addEventListener('resize', function () {
        if (window.innerWidth >= 640) {
            mobileMenu.classList.remove('menu__links-mobile--open');
            if (overlay) overlay.style.display = 'none';
            document.body.style.overflow = '';
        }
    });
});
