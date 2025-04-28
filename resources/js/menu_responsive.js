// menu_responsive.js - Optimizado para menú BEM responsive

document.addEventListener('DOMContentLoaded', function () {
    const burger = document.querySelector('.menu__burger');
    const mobileMenu = document.querySelector('.menu__links-mobile');
    const overlay = document.querySelector('.menu__overlay');
    let isOpen = false;

    if (!burger || !mobileMenu) return;

    function openMenu() {
        mobileMenu.classList.add('menu__links-mobile--open');
        if (overlay) overlay.style.display = 'block';
        document.body.style.overflow = 'hidden';
        isOpen = true;
    }
    function closeMenu() {
        mobileMenu.classList.remove('menu__links-mobile--open');
        if (overlay) overlay.style.display = 'none';
        document.body.style.overflow = '';
        isOpen = false;
    }
    function toggleMenu() {
        isOpen ? closeMenu() : openMenu();
    }

    burger.addEventListener('click', toggleMenu);
    if (overlay) overlay.addEventListener('click', closeMenu);

    window.addEventListener('resize', function () {
        if (window.innerWidth >= 640 && isOpen) {
            closeMenu();
        }
    });
});