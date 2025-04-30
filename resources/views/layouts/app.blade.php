<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        {{-- SEO Meta Tags Dinámicos --}}
        @include('layouts.partials.seo')

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
        <!-- Blade: Favicon -->
        <link rel="icon" href="{{ asset('favicon.ico') }}" type="image/x-icon">

        <!-- Scripts -->
        @vite(['resources/css/main.css', 'resources/js/app.js'])
    </head>
    <body>
        @include('components.top-banner')
        <div>
            @include('layouts.navigation')

            <!-- Page Heading -->
            @isset($header)
                <header>
                    <div>
                        {{ $header }}
                    </div>
                </header>
            @endisset

            <!-- Page Content -->
            <main>
                {{ $slot ??'' }}
            </main>

            <!-- Footer -->
            <x-footer />
        </div>

        <!-- Botón flotante para subir al menú (global) -->
        <!-- Botón flotante para subir al menú (PRUEBA SIEMPRE VISIBLE) -->
        <div id="scrollToTopBtnContainer" style="display: block !important; position: fixed; right: 24px; bottom: 104px; z-index: 9999;">
            <button id="scrollToTopBtn" style="background: #2563eb; color: #fff; border-radius: 50%; box-shadow: 0 2px 8px rgba(0,0,0,0.15); width: 56px; height: 56px; display: flex; align-items: center; justify-content: center; border: none; cursor: pointer;">
                <!-- Icono de flecha hacia arriba -->
                <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M5 15l7-7 7 7" />
                </svg>
            </button>
        </div>
        <script>
document.addEventListener('DOMContentLoaded', function() {
    var btn = document.getElementById('scrollToTopBtn');
    var container = document.getElementById('scrollToTopBtnContainer');
    function toggleBtn() {
        if (window.scrollY > 120) {
            container.style.display = 'block';
        } else {
            container.style.display = 'none';
        }
    }
    if (btn && container) {
        btn.addEventListener('click', function() {
            window.scrollTo({top: 0, behavior: 'smooth'});
        });
        window.addEventListener('scroll', toggleBtn);
        toggleBtn(); // Inicializar estado al cargar
    }
});
</script>
        <script src="{{ asset('js/menu.js') }}"></script>
@stack('scripts')
    </body>
</html>
