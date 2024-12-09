<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>PT Trans Marga Jateng</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <script src="https://unpkg.com/lucide@latest"></script>
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@2.8.2/dist/alpine.min.js" defer></script>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap');

        body {
            font-family: 'Poppins', sans-serif;
        }

        .bg-navy-blue {
            background-color: #000080;
        }
        .text-navy-blue {
            color: #000080;
        }
        .hover\:bg-navy-blue:hover {
            background-color: #000080;
        }
        .border-navy-blue {
            border-color: #000080;
        }

        .transition-transform {
            transition-property: transform;
            transition-timing-function: cubic-bezier(0.4, 0, 0.2, 1);
            transition-duration: 150ms;
        }

        .hover\:scale-105:hover {
            transform: scale(1.05);
        }

        .animate-fade-in {
            animation: fadeIn 0.5s ease-out;
        }

        @keyframes fadeIn {
            from { opacity: 0; }
            to { opacity: 1; }
        }
    </style>
</head>
<body class="flex flex-col min-h-screen bg-gray-50">
    <header x-data="{ isOpen: false }" class="sticky top-0 z-50 w-full border-b bg-white shadow-sm">
        <div class="container mx-auto flex h-16 items-center justify-between px-4 sm:px-6 lg:px-8">
            <a href="{{ url('/') }}" class="flex items-center space-x-2">
                <img src="{{ asset('images/GambarTMJ.jpg') }}" alt="PT Trans Marga Jateng Logo" class="h-10 w-auto" width="80" height="60">
            </a>
            <nav class="hidden md:flex gap-6 items-center">
                <a class="text-sm font-medium text-navy-blue hover:text-green-600 transition-colors duration-200" href="#tentang">Tentang</a>
                <a class="text-sm font-medium text-navy-blue hover:text-green-600 transition-colors duration-200" href="#layanan">Layanan</a>
                <a class="text-sm font-medium text-navy-blue hover:text-green-600 transition-colors duration-200" href="#kontak">Kontak</a>
                <div x-data="{ open: false }" class="relative">
                    <button @click="open = !open" class="inline-flex items-center justify-center rounded-md text-sm font-medium ring-offset-background transition-colors focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 disabled:pointer-events-none disabled:opacity-50 border border-input bg-background hover:bg-accent hover:text-accent-foreground h-10 px-4 py-2 border-navy-blue text-navy-blue hover:bg-navy-blue hover:text-white">
                        Masuk
                    </button>
                    <div x-show="open" @click.away="open = false" class="absolute right-0 mt-2 w-56 rounded-md shadow-lg bg-white ring-1 ring-black ring-opacity-5 divide-y divide-gray-100 focus:outline-none" role="menu" aria-orientation="vertical" aria-labelledby="options-menu">
                        <div class="py-1" role="none">
                            <a href="/admin/login" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 hover:text-gray-900" role="menuitem">Admin</a>
                            <a href="/user/login" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 hover:text-gray-900" role="menuitem">User</a>
                            <a href="/verificator/login" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 hover:text-gray-900" role="menuitem">Verificator</a>
                            <a href="/validator/login" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 hover:text-gray-900" role="menuitem">Validator</a>
                            <a href="/viewer/login" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 hover:text-gray-900" role="menuitem">Viewer</a>
                        </div>
                    </div>
                </div>
            </nav>
            <button @click="isOpen = !isOpen" class="md:hidden rounded-md p-2 inline-flex items-center justify-center text-navy-blue hover:text-navy-blue hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-inset focus:ring-navy-blue">
                <span class="sr-only">Open main menu</span>
                <svg class="h-6 w-6" x-show="!isOpen" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                </svg>
                <svg class="h-6 w-6" x-show="isOpen" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </div>
        <div x-show="isOpen" class="md:hidden">
            <div class="px-2 pt-2 pb-3 space-y-1 sm:px-3">
                <a href="#tentang" class="block px-3 py-2 rounded-md text-base font-medium text-navy-blue hover:text-white hover:bg-navy-blue">Tentang</a>
                <a href="#layanan" class="block px-3 py-2 rounded-md text-base font-medium text-navy-blue hover:text-white hover:bg-navy-blue">Layanan</a>
                <a href="#kontak" class="block px-3 py-2 rounded-md text-base font-medium text-navy-blue hover:text-white hover:bg-navy-blue">Kontak</a>
                <div x-data="{ open: false }" class="relative">
                    <button @click="open = !open" class="w-full text-left block px-3 py-2 rounded-md text-base font-medium text-navy-blue hover:text-white hover:bg-navy-blue">
                        Masuk
                    </button>
                    <div x-show="open" class="px-2 py-2 space-y-1">
                        <a href="/admin/login" class="block px-3 py-2 rounded-md text-base font-medium text-gray-700 hover:text-white hover:bg-navy-blue">Admin</a>
                        <a href="/user/login" class="block px-3 py-2 rounded-md text-base font-medium text-gray-700 hover:text-white hover:bg-navy-blue">User</a>
                        <a href="/verificator/login" class="block px-3 py-2 rounded-md text-base font-medium text-gray-700 hover:text-white hover:bg-navy-blue">Verificator</a>
                        <a href="/validator/login" class="block px-3 py-2 rounded-md text-base font-medium text-gray-700 hover:text-white hover:bg-navy-blue">Validator</a>
                        <a href="/viewer/login" class="block px-3 py-2 rounded-md text-base font-medium text-gray-700 hover:text-white hover:bg-navy-blue">Viewer</a>
                    </div>
                </div>
            </div>
        </div>
    </header>

    <main class="flex-1">
        <section class="w-full py-12 md:py-24 lg:py-32 xl:py-48 bg-gradient-to-r from-green-500 via-yellow-400 to-green-500">
            <div class="container mx-auto px-4 md:px-6 max-w-7xl">
                <div class="flex flex-col items-center space-y-4 text-center">
                    <div class="space-y-2 max-w-3xl mx-auto">
                        <h1 class="text-3xl font-bold tracking-tighter sm:text-4xl md:text-5xl lg:text-6xl/none text-navy-blue animate-fade-in">
                            Selamat Datang di PT Trans Marga Jateng
                        </h1>
                        <p class="mx-auto max-w-[700px] text-navy-blue md:text-xl animate-fade-in">
                            Menghubungkan Jawa Tengah melalui infrastruktur transportasi yang berkelanjutan dan inovatif.
                        </p>
                    </div>
                    <a href="#kontak" class="inline-flex items-center justify-center rounded-md text-sm font-medium ring-offset-background transition-colors focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 disabled:pointer-events-none disabled:opacity-50 bg-primary text-primary-foreground hover:bg-primary/90 h-10 px-4 py-2 bg-navy-blue text-white hover:bg-blue-800 animate-fade-in">
                        Hubungi Kami
                    </a>
                </div>
            </div>
        </section>

        <section id="layanan" class="w-full py-12 md:py-24 lg:py-32 bg-white">
            <div class="container mx-auto px-4 md:px-6 max-w-7xl">
                <h2 class="text-3xl font-bold tracking-tighter sm:text-4xl md:text-5xl mb-8 text-center text-navy-blue">Layanan Kami</h2>
                <div class="grid gap-6 sm:grid-cols-2 lg:grid-cols-3 justify-items-center">
                    @foreach ([
                        ['title' => 'Pengelolaan Jalan Tol', 'content' => 'Pengelolaan dan pemeliharaan jalan tol yang efisien di seluruh Jawa Tengah.', 'border' => 'border-green-500', 'icon' => 'road'],
                        ['title' => 'Pengembangan Infrastruktur', 'content' => 'Perencanaan dan pelaksanaan proyek infrastruktur transportasi baru.', 'border' => 'border-yellow-400', 'icon' => 'building'],
                        ['title' => 'Manajemen Lalu Lintas', 'content' => 'Sistem canggih untuk kelancaran arus lalu lintas dan peningkatan keselamatan jalan.', 'border' => 'border-green-500', 'icon' => 'traffic-cone']
                    ] as $service)
                        <div class="w-full max-w-sm rounded-lg border bg-card text-card-foreground shadow-sm {{ $service['border'] }} transition-transform hover:scale-105">
                            <div class="flex flex-col space-y-1.5 p-6">
                                <i data-lucide="{{ $service['icon'] }}" class="w-8 h-8 mb-2 text-navy-blue"></i>
                                <h3 class="text-2xl font-semibold leading-none tracking-tight text-navy-blue">{{ $service['title'] }}</h3>
                            </div>
                            <div class="p-6 pt-0 text-navy-blue">
                                {{ $service['content'] }}
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>

        <section id="tentang" class="w-full py-12 md:py-24 lg:py-32 bg-gray-100">
            <div class="container mx-auto px-4 md:px-6 max-w-7xl">
                <div class="grid gap-6 lg:grid-cols-2 lg:gap-12 items-center">
                    <img src="{{ asset('images/GambarTol.jpeg') }}" alt="Tentang PT Trans Marga Jateng" class="mx-auto aspect-video overflow-hidden rounded-xl object-cover object-center sm:w-full lg:order-last shadow-lg">
                    <div class="flex flex-col justify-center space-y-4">
                        <h2 class="text-3xl font-bold tracking-tighter sm:text-4xl text-navy-blue">Tentang Kami</h2>
                        <p class="max-w-[600px] text-navy-blue md:text-xl/relaxed lg:text-base/relaxed xl:text-xl/relaxed">
                            PT Trans Marga Jateng berdedikasi untuk mengembangkan dan mengelola infrastruktur transportasi berkualitas tinggi
                            di Jawa Tengah. Dengan fokus pada inovasi dan keberlanjutan, kami berusaha meningkatkan konektivitas dan
                            mendorong pertumbuhan ekonomi di wilayah ini.
                        </p>
                    </div>
                </div>
            </div>
        </section>

        <section id="kontak" class="w-full py-12 md:py-24 lg:py-32 bg-white">
            <div class="container mx-auto px-4 md:px-6 max-w-7xl">
                <h2 class="text-3xl font-bold tracking-tighter sm:text-4xl md:text-5xl mb-8 text-center text-navy-blue">Hubungi Kami</h2>
                <div class="grid gap-6 lg:grid-cols-2 lg:gap-12 items-start">
                    <div class="space-y-4">
                        <div class="flex items-center space-x-2 text-navy-blue">
                            <i data-lucide="map-pin"></i>
                            <span>Jl Mulawarman Raya No.1B RT.002 RW.004 Kel. Pedalangan Kec.Banyumanik Semarang, Jawa Tengah 50268</span>
                        </div>
                        <div class="flex items-center space-x-2 text-navy-blue">
                            <i data-lucide="phone"></i>
                            <span>+62 24 1234 5678</span>
                        </div>
                        <div class="flex items-center space-x-2 text-navy-blue">
                            <i data-lucide="mail"></i>
                            <span>info@transmargajateng.co.id</span>
                        </div>
                    </div>
                    <form class="space-y-4">
                        <div>
                            <label for="name" class="block text-sm font-medium text-navy-blue">Nama</label>
                            <input type="text" id="name" name="name" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-navy-blue focus:ring focus:ring-navy-blue focus:ring-opacity-50">
                        </div>
                        <div>
                            <label for="email" class="block text-sm font-medium text-navy-blue">Email</label>
                            <input type="email" id="email" name="email" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-navy-blue focus:ring focus:ring-navy-blue focus:ring-opacity-50">
                        </div>
                        <div>
                            <label for="message" class="block text-sm font-medium text-navy-blue">Pesan</label>
                            <textarea id="message" name="message" rows="4" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-navy-blue focus:ring focus:ring-navy-blue focus:ring-opacity-50"></textarea>
                        </div>
                        <button type="submit" class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-navy-blue hover:bg-blue-800 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-navy-blue">
                            Kirim Pesan
                        </button>
                    </form>
                </div>
            </div>
        </section>
    </main>

    <footer class="w-full py-6 bg-navy-blue text-white">
        <div class="container mx-auto px-4 md:px-6 max-w-7xl">
            <div class="flex flex-col items-center justify-between gap-4 md:flex-row">
                <p class="text-sm">
                    © {{ date('Y') }} PT Trans Marga Jateng. Hak Cipta Dilindungi.
                </p>
            </div>
        </div>
    </footer>

    <script>
        lucide.createIcons();
    </script>
</body>
</html>
