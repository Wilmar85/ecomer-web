// JS vainilla para galería de imágenes en la página de producto

document.addEventListener('DOMContentLoaded', function () {
    const gallery = document.querySelector('.products-show__gallery [data-gallery]');
    if (!gallery) return;

    const mainImg = gallery.querySelector('[data-gallery-main]');
    const thumbs = gallery.querySelectorAll('[data-gallery-thumb]');

    thumbs.forEach(function(thumb) {
        thumb.addEventListener('click', function() {
            if (mainImg && thumb.dataset.src) {
                mainImg.src = thumb.dataset.src;
            }
        });
    });
});
