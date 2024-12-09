import preset from '../../../../vendor/filament/filament/tailwind.config.preset'

export default {
    presets: [preset],
    content: [
        './app/Filament/Validator/**/*.php',
        './resources/views/filament/validator/**/*.blade.php',
        './vendor/filament/**/*.blade.php',
    ],
}
