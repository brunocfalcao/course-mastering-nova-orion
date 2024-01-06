import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import path from 'path';
import fs from 'fs';

export default defineConfig({
    plugins: [
        laravel([
            'resources/css/app.css',
            'resources/js/app.js'
        ]),
    ],
    build: {
        assetsInclude: ['**/*.woff2', '**/*.woff', '**/*.ttf'],
        outDir: path.resolve(__dirname, `public/courses/course-mastering-nova-orion`),
    },
});
