import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        // laravel({
        //     input: [
        //         'resources/sass/app.scss',
        //         'resources/js/app.js',
        //     ],
        //     refresh: true,
        // }),
        laravel({
            input: [
                'resources/sass/app.scss',
                'resources/js/app.js',
                'public/dist/css/admin.css',
                'public/dist/js/admin.js',
            ],
            refresh: true,
        }),
    ],
});
