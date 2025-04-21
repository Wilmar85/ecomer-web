import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: ['resources/css/app.css', 'resources/sass/main.scss', 'resources/js/app.js'],
            refresh: true,
        }),
    ],
    server: {
        host: process.env.VITE_HOST || 'localhost', // Alterna entre localhost y 0.0.0.0 según variable de entorno
        cors: true, // Permite CORS para desarrollo
    },
});
