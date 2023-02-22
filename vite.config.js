import { defineConfig } from 'vite';
import laravel, { refreshPaths } from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/css/app.css',
                'resources/css/coolHr.css',

                'resources/js/app.js',
                'resources/js/uploadImage.js',
                'resources/js/comment.js',
                'resources/js/detailImage.js',
                'resources/js/friendship.js',
                'resources/js/friendRequest.js',
            ],
            refresh: [
                ...refreshPaths,
                'app/Http/Livewire/**',
            ],
        }),
    ],
});
