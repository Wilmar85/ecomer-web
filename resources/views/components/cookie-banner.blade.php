<div class="cookie-banner" x-data="{ show: sessionStorage.getItem('cookieAccepted') !== 'true' }" x-show="show" x-cloak>
    <span>
        Utilizamos cookies para mejorar tu experiencia en nuestro sitio web, en cumplimiento de la Ley Colombiana 1581 de 2012 y el Decreto 1377 de 2013.
    </span>
    <button class="cookie-banner__btn" @click="sessionStorage.setItem('cookieAccepted', 'true'); show = false;">
        Aceptar
    </button>
</div>
