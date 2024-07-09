import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/css/apps.css',
                'resources/js/apps.js',
            ],
            refresh: true,
        }),
    ],
});
