import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import { viteStaticCopy } from 'vite-plugin-static-copy';


export default defineConfig({
    base: '/build/',
    plugins: [
        laravel({
            input: [
                'resources/sass/main.scss',
                'resources/js/app.js'
            ],
            refresh: true,
        }),
        viteStaticCopy({
            targets: [
                {
                    src: 'public/favicon.ico',
                    dest: ''
                }
            ]
        })
    ],
    server: {
        host: process.env.VITE_HOST || 'localhost',
        cors: true,
    },
   
});
