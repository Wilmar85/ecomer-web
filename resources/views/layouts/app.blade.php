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
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans antialiased">
        @include('components.top-banner')
        <div class="min-h-screen bg-gray-100 flex flex-col">
            @include('layouts.navigation')

            <!-- Page Heading -->
            @isset($header)
                <header class="bg-white shadow">
                    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                        {{ $header }}
                    </div>
                </header>
            @endisset

            <!-- Page Content -->
            <main class="flex-grow">
                {{ $slot ??'' }}
            </main>

            <!-- Footer -->
            <x-footer />
        </div>

        <!-- Botón flotante para subir al menú (global) -->
        <div x-data="{ showBtn: false }" x-init="window.addEventListener('scroll', () => { showBtn = window.scrollY > 100; Alpine.store('scrollBtn').visible = showBtn })" style="display: contents;">
            <div x-show="showBtn" style="display: none;" class="fixed right-6 bottom-[104px] sm:bottom-[104px] z-50">
                <button @click="window.scrollTo({top: 0, behavior: 'smooth'})" class="bg-blue-600 hover:bg-blue-800 text-white rounded-full shadow-lg flex items-center justify-center w-14 h-14 transition duration-200 focus:outline-none">
                    <!-- Icono de flecha hacia arriba -->
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-7 w-7" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M5 15l7-7 7 7" />
                    </svg>
                </button>
            </div>
        </div>
        <script>
        document.addEventListener('alpine:init', () => {
            if (!Alpine.store('scrollBtn')) {
                Alpine.store('scrollBtn', { visible: false });
            }
        });
        </script>
        @stack('scripts')
    </body>
</html>
