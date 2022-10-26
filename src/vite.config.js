import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import path from 'path';
 
export default defineConfig({
    resolve: {
        alias: {
            '~bootstrap': path.resolve(__dirname, 'node_modules/bootstrap'),
            '~toastr': path.resolve(__dirname, 'node_modules/toastr'),
        }
    },
    plugins: [
        laravel({
            input: [
                'resources/sass/shop.scss',
                'resources/js/shop/app.js',
            ],
            refresh: true,
        }),
    ],
});