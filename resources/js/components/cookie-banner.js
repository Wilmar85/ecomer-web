// resources/js/components/cookie-alert.js

/**
 * Función para inicializar la lógica del banner de cookies.
 */
const initCookieAlert = () => {
  // Selecciona los elementos necesarios por ID
  const cookieAlert = document.getElementById('cookie-alert');
  const acceptButton = document.getElementById('accept-cookies');

  // Verifica si ambos elementos existen en la página actual
  if (cookieAlert && acceptButton) {
    // Añade el listener al botón de aceptar
    acceptButton.addEventListener('click', () => {
      // Oculta el banner añadiendo la clase 'hidden'
      cookieAlert.classList.add('hidden');
      // No se guarda estado para que reaparezca en la siguiente carga
    });
  } else {
    // Opcional: Muestra un mensaje si no se encuentran los elementos
    // console.info('Componente de alerta de cookies no encontrado en esta página.');
  }
};

/**
 * Ejecuta la inicialización cuando el DOM esté listo.
 * Si estás usando un sistema de módulos (como en Laravel Mix/Vite),
 * podrías exportar la función y llamarla desde tu app.js principal,
 * o simplemente ejecutarla aquí si este script se carga globalmente.
 */
if (document.readyState === 'loading') {
  // Loading hasn't finished yet
  document.addEventListener('DOMContentLoaded', initCookieAlert);
} else {
  // `DOMContentLoaded` has already fired
  initCookieAlert();
}

// Si usas módulos y quieres importarlo en app.js:
// export default initCookieAlert;
