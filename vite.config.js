import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/css/app.css',
                'resources/js/app.js'
            ],
            refresh: true,
        }),
    ],
    publicDir: 'resources/img',
    build: {
        outDir: 'public/build',
        assetsDir: 'assets'
    }
});
