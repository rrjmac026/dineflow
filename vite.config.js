import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/css/app.css',
                'resources/js/app.js',
            ],
            refresh: true,
        }),
    ],

    server: {
        host: '0.0.0.0',
        cors: {
            origin: [
                'http://dineflow.com:8000',
                'http://tenant1.dineflow.com:8000'
            ]
        },

        hmr: {
            host: 'dineflow.com'
        }
    }
});
