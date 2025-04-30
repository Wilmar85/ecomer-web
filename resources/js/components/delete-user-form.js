// JS vainilla para abrir el modal de confirmación de eliminación de usuario

document.addEventListener('DOMContentLoaded', function () {
    document.querySelectorAll('[data-delete-user-btn]').forEach(function(btn) {
        btn.addEventListener('click', function(e) {
            e.preventDefault();
            const event = new CustomEvent('open-modal', { detail: 'confirm-user-deletion' });
            window.dispatchEvent(event);
        });
    });
});
