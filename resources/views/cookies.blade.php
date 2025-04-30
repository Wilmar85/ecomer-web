@extends('layouts.app')

@section('content')
<div class="cookies">
    <div class="cookies__card">
        <h1 class="cookies__title">Política de Cookies</h1>
        <p class="cookies__paragraph">
            Este sitio web utiliza cookies para mejorar la experiencia del usuario, analizar el tráfico y personalizar el contenido, cumpliendo con la <b>Ley 1581 de 2012</b>, el <b>Decreto 1377 de 2013</b> y las directrices de la <b>Superintendencia de Industria y Comercio (SIC)</b> de Colombia.
        </p>
        <h2 class="cookies__subtitle">¿Qué son las cookies?</h2>
        <p class="cookies__paragraph">
            Las cookies son pequeños archivos de texto que se almacenan en su dispositivo cuando visita un sitio web. Sirven para recordar sus preferencias y mejorar su experiencia de navegación.
        </p>
        <h2 class="cookies__subtitle">¿Qué tipos de cookies usamos?</h2>
        <ul class="cookies__list">
            <li><b>Cookies necesarias:</b> Permiten el funcionamiento básico del sitio.</li>
            <li><b>Cookies de análisis:</b> Nos ayudan a entender cómo interactúan los usuarios con el sitio.</li>
            <li><b>Cookies de personalización:</b> Recuerdan sus preferencias.</li>
        </ul>
        <h2 class="cookies__subtitle">Consentimiento</h2>
        <p class="cookies__paragraph">
            Al navegar por este sitio, usted acepta el uso de cookies conforme a esta política. Puede configurar su navegador para rechazar cookies, pero esto puede afectar la funcionalidad del sitio.
        </p>
        <h2 class="cookies__subtitle">Sus derechos</h2>
        <p class="cookies__paragraph">
            Usted puede solicitar información, actualización, rectificación y supresión de sus datos personales. Para ejercer estos derechos, contáctenos a través del formulario de contacto.
        </p>
        <h2 class="cookies__subtitle">Contacto</h2>
        <p>
            Si tiene preguntas sobre nuestra política de cookies, escríbanos desde la sección de <a href="{{ route('contact') }}" class="text-blue-600 underline">Contacto</a>.
        </p>
    </div>
</div>
@endsection
