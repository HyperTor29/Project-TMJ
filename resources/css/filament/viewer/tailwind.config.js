import preset from '../../../../vendor/filament/filament/tailwind.config.preset'

export default {
    presets: [preset],
    content: [
        './app/Filament/Viewer/**/*.php',
        './resources/views/filament/viewer/**/*.blade.php',
        './vendor/filament/**/*.blade.php',
    ],
}
