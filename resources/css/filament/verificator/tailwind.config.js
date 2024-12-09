import preset from '../../../../vendor/filament/filament/tailwind.config.preset'

export default {
    presets: [preset],
    content: [
        './app/Filament/Verificator/**/*.php',
        './resources/views/filament/verificator/**/*.blade.php',
        './vendor/filament/**/*.blade.php',
    ],
}
