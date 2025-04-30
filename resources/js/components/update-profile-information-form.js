// JS vainilla para mostrar/ocultar el mensaje de verificación enviada en el formulario de perfil

document.addEventListener('DOMContentLoaded', function () {
    document.querySelectorAll('[data-verification-link-sent-msg]').forEach(function(el) {
        el.style.display = '';
        setTimeout(function() {
            el.style.display = 'none';
        }, 2000);
    });
});
