// JS vainilla para mostrar/ocultar el mensaje de éxito en el cambio de contraseña

document.addEventListener('DOMContentLoaded', function () {
    document.querySelectorAll('[data-password-updated-msg]').forEach(function(el) {
        el.style.display = '';
        setTimeout(function() {
            el.style.display = 'none';
        }, 2000);
    });
});
