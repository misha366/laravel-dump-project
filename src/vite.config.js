import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/css/app.css',
                'resources/css/common.styles.css',
                'resources/css/import.bootstrap.css',
                'resources/css/mainpage.css',
                'resources/css/setfont.css',
                'resources/js/app.js',
                'resources/js/homepage-particles.js',
                'resources/js/preloader.js',
                'resources/js/two-factor-challenge-toggler.js',
            ],
            refresh: true,
        }),
    ],
    server: {
        host: '0.0.0.0',
        port: 5173,
        hmr: {
            host: 'localhost',
            port: 5173,
        },
    },
});
