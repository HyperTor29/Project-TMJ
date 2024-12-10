import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/css/app.css',
                'resources/js/app.js',
                // 'resources/css/filament/admin/theme.css',
                // 'resources/css/filament/user/theme.css',
                // 'resources/css/filament/verificator/theme.css',
                // `resources/css/filament/validator/theme.css`,
                // `resources/css/filament/viewer/theme.css`
            ],
            refresh: true,
        }),
    ],
});
