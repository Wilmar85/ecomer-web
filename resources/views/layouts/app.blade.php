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
            <!-- Page Heading -->
    {{-- El <header> principal ahora siempre se renderiza --}}
        <header class="header" > {{-- Puedes añadir clases CSS aquí si necesitas --}}

            {{-- El top banner y la navegación están DENTRO del header y SIEMPRE se incluyen --}}
            @include('components.top-banner')
            @include('layouts.navigation')

            {{-- El contenido específico de $header solo se muestra SI existe --}}
            @isset($header)
                <div class="page-specific-header-content"> {{-- Contenedor para el contenido opcional --}}
                    {{ $header }}
                </div>
            @endisset
        </header> {{-- Fin del <header> principal --}}
            <!-- Page Content -->
        <main class="main" >
                {{ $slot  }}
        </main>

            <!-- Footer -->
        <footer class="footer">
             <x-footer />
        </footer>

        <!-- Botón flotante para subir al menú (global) -->
        <x-scroll-top />
        <!-- Botón flotante de WhatsApp -->
        <x-whassap-button />
    </body>
</html>
