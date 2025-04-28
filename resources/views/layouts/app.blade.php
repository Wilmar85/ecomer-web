<!DOCTYPE html>
<html>
<head>
    @vite(['resources/js/app.js'])
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
        <button x-show="showBtn" style="display: none;" @click="window.scrollTo({top: 0, behavior: 'smooth'})" class="scroll-to-top-btn" aria-label="Subir al menú">
            <!-- Icono de flecha hacia arriba -->
            <svg xmlns="http://www.w3.org/2000/svg" class="h-7 w-7" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M5 15l7-7 7 7" />
            </svg>
        </button>
    </div>
    <!-- Banner de Cookies -->
    @include('components.cookie-banner')
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
