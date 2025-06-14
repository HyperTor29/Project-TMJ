import preset from '../../../../vendor/filament/filament/tailwind.config.preset'

export default {
    presets: [preset],
    content: [
        './app/Filament/**/*.php',
        './resources/views/filament/**/*.blade.php',
        './vendor/filament/**/*.blade.php',
        './resources/views/**/*.blade.php',
    ],
    safelist: [
        'bg-green-600',
        'hover:bg-green-700',
        'focus:ring-green-300',

        'bg-red-600',
        'hover:bg-red-700',
        'focus:ring-red-300',

        'bg-white',
        'hover:bg-blue-700',
        'focus:ring-blue-300',

        'text-black',
        'text-sm',
        'font-medium',
        'rounded-md',
        'shadow',
        'transition-all',
        'duration-300',
        'focus:outline-none',
        'focus:ring-2',
        'px-4',
        'py-2',
    ],
}
