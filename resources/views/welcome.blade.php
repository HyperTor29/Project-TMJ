<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Tertib Lolos - PT Trans Marga Jateng</title>
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

        .hero-gradient {
            background: linear-gradient(135deg, #4CAF50 0%, #FFD700 50%, #4CAF50 100%);
            animation: gradientShift 15s ease infinite;
        }

        @keyframes gradientShift {
            0% { background-position: 0% 50%; }
            50% { background-position: 100% 50%; }
            100% { background-position: 0% 50%; }
        }

        .card-hover {
            transition: all 0.3s ease;
        }

        .card-hover:hover {
            transform: translateY(-10px);
            box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
        }

        .animate-float {
            animation: float 6s ease-in-out infinite;
        }

        @keyframes float {
            0% { transform: translateY(0px); }
            50% { transform: translateY(-20px); }
            100% { transform: translateY(0px); }
        }

        .nav-link {
            position: relative;
        }

        .nav-link::after {
            content: '';
            position: absolute;
            width: 0;
            height: 2px;
            bottom: -4px;
            left: 0;
            background-color: #4CAF50;
            transition: width 0.3s ease;
        }

        .nav-link:hover::after {
            width: 100%;
        }
    </style>
</head>
<body class="flex flex-col min-h-screen bg-gray-50">
    <header x-data="{ isOpen: false }" class="sticky top-0 z-50 w-full border-b bg-white/95 backdrop-blur-sm shadow-sm">
        <div class="container mx-auto flex h-16 items-center justify-between px-4 sm:px-6 lg:px-8">
            <a href="{{ url('/') }}" class="flex items-center space-x-2 group">
                <img src="{{ asset('images/GambarTMJ.jpg') }}" alt="Tertib Lolos Logo" class="h-10 w-auto transform transition-transform group-hover:scale-105" width="80" height="60">
                <span class="text-xl font-bold text-navy-blue group-hover:text-green-600 transition-colors">Tertib Lolos</span>
            </a>
            <nav class="hidden md:flex gap-8 items-center">
                <a class="nav-link text-sm font-medium text-navy-blue hover:text-green-600 transition-colors duration-200" href="#tentang">Tentang</a>
                <a class="nav-link text-sm font-medium text-navy-blue hover:text-green-600 transition-colors duration-200" href="#fitur">Fitur</a>
                <a class="nav-link text-sm font-medium text-navy-blue hover:text-green-600 transition-colors duration-200" href="#kontak">Kontak</a>
                <div x-data="{ open: false }" class="relative">
                    <button @click="open = !open" class="inline-flex items-center justify-center rounded-md text-sm font-medium transition-all duration-200 focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-green-500 focus-visible:ring-offset-2 border-2 border-navy-blue text-navy-blue hover:bg-navy-blue hover:text-white h-10 px-6 py-2">
                        Masuk
                    </button>
                    <div x-show="open" @click.away="open = false" x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0 scale-95" x-transition:enter-end="opacity-100 scale-100" x-transition:leave="transition ease-in duration-150" x-transition:leave-start="opacity-100 scale-100" x-transition:leave-end="opacity-0 scale-95" class="absolute right-0 mt-2 w-56 rounded-lg shadow-lg bg-white ring-1 ring-black ring-opacity-5 divide-y divide-gray-100 focus:outline-none" role="menu">
                        <div class="py-1" role="none">
                            <a href="/admin/login" class="group flex items-center px-4 py-2 text-sm text-gray-700 hover:bg-navy-blue hover:text-white transition-colors duration-150" role="menuitem">
                                <i data-lucide="user-cog" class="mr-3 h-4 w-4"></i>Admin
                            </a>
                            <a href="/user/login" class="group flex items-center px-4 py-2 text-sm text-gray-700 hover:bg-navy-blue hover:text-white transition-colors duration-150" role="menuitem">
                                <i data-lucide="user" class="mr-3 h-4 w-4"></i>User(CS)
                            </a>
                            <a href="/verificator/login" class="group flex items-center px-4 py-2 text-sm text-gray-700 hover:bg-navy-blue hover:text-white transition-colors duration-150" role="menuitem">
                                <i data-lucide="check-circle" class="mr-3 h-4 w-4"></i>Verificator(CSS)
                            </a>
                            <a href="/validator/login" class="group flex items-center px-4 py-2 text-sm text-gray-700 hover:bg-navy-blue hover:text-white transition-colors duration-150" role="menuitem">
                                <i data-lucide="shield" class="mr-3 h-4 w-4"></i>Validator(Asmen)
                            </a>
                            <a href="/viewer/login" class="group flex items-center px-4 py-2 text-sm text-gray-700 hover:bg-navy-blue hover:text-white transition-colors duration-150" role="menuitem">
                                <i data-lucide="eye" class="mr-3 h-4 w-4"></i>Viewer
                            </a>
                        </div>
                    </div>
                </div>
            </nav>
            <button @click="isOpen = !isOpen" class="md:hidden rounded-md p-2 inline-flex items-center justify-center text-navy-blue hover:text-navy-blue hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-inset focus:ring-navy-blue">
                <span class="sr-only">Open main menu</span>
                <svg class="h-6 w-6" x-show="!isOpen" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                </svg>
                <svg class="h-6 w-6" x-show="isOpen" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </div>
        <div x-show="isOpen" class="md:hidden">
            <div class="px-2 pt-2 pb-3 space-y-1">
                <a href="#tentang" class="block px-3 py-2 rounded-md text-base font-medium text-navy-blue hover:text-white hover:bg-navy-blue transition-colors duration-150">Tentang</a>
                <a href="#fitur" class="block px-3 py-2 rounded-md text-base font-medium text-navy-blue hover:text-white hover:bg-navy-blue transition-colors duration-150">Fitur</a>
                <a href="#kontak" class="block px-3 py-2 rounded-md text-base font-medium text-navy-blue hover:text-white hover:bg-navy-blue transition-colors duration-150">Kontak</a>
                <div x-data="{ open: false }" class="relative">
                    <button @click="open = !open" class="w-full text-left block px-3 py-2 rounded-md text-base font-medium text-navy-blue hover:text-white hover:bg-navy-blue transition-colors duration-150">
                        Masuk
                    </button>
                    <div x-show="open" class="px-2 py-2 space-y-1">
                        <a href="/admin/login" class="flex items-center px-3 py-2 rounded-md text-base font-medium text-gray-700 hover:text-white hover:bg-navy-blue transition-colors duration-150">
                            <i data-lucide="user-cog" class="mr-3 h-4 w-4"></i>Admin
                        </a>
                        <a href="/user/login" class="flex items-center px-3 py-2 rounded-md text-base font-medium text-gray-700 hover:text-white hover:bg-navy-blue transition-colors duration-150">
                            <i data-lucide="user" class="mr-3 h-4 w-4"></i>User
                        </a>
                        <a href="/verificator/login" class="flex items-center px-3 py-2 rounded-md text-base font-medium text-gray-700 hover:text-white hover:bg-navy-blue transition-colors duration-150">
                            <i data-lucide="check-circle" class="mr-3 h-4 w-4"></i>Verificator
                        </a>
                        <a href="/validator/login" class="flex items-center px-3 py-2 rounded-md text-base font-medium text-gray-700 hover:text-white hover:bg-navy-blue transition-colors duration-150">
                            <i data-lucide="shield" class="mr-3 h-4 w-4"></i>Validator
                        </a>
                        <a href="/viewer/login" class="flex items-center px-3 py-2 rounded-md text-base font-medium text-gray-700 hover:text-white hover:bg-navy-blue transition-colors duration-150">
                            <i data-lucide="eye" class="mr-3 h-4 w-4"></i>Viewer
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </header>

    <main class="flex-1">
        <section class="relative w-full py-12 md:py-24 lg:py-32 xl:py-48 hero-gradient overflow-hidden">
            <div class="absolute inset-0 bg-grid-white/[0.1] bg-[size:60px_60px]"></div>
            <div class="container mx-auto px-4 md:px-6 max-w-7xl relative">
                <div class="flex flex-col items-center space-y-8 text-center">
                    <div class="space-y-4 max-w-3xl mx-auto">
                        <h1 class="text-4xl font-bold tracking-tighter sm:text-5xl md:text-6xl lg:text-7xl text-navy-blue animate-float">
                            Selamat Datang di Tertib Lolos
                        </h1>
                        <p class="mx-auto max-w-[700px] text-navy-blue text-lg md:text-xl lg:text-2xl animate-fade-in">
                            Sistem manajemen perizinan kendaraan pintar untuk kelancaran lalu lintas di gerbang tol PT Trans Marga Jateng.
                        </p>
                    </div>
                    <a href="#kontak" class="group inline-flex items-center justify-center rounded-full text-base font-medium transition-all duration-200 focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-green-500 focus-visible:ring-offset-2 bg-navy-blue text-white hover:bg-green-600 h-12 px-8 py-3 animate-fade-in">
                        Hubungi Kami
                        <i data-lucide="arrow-right" class="ml-2 h-5 w-5 transform transition-transform group-hover:translate-x-1"></i>
                    </a>
                </div>
            </div>
        </section>

        <section id="fitur" class="w-full py-16 md:py-24 lg:py-32 bg-white">
            <div class="container mx-auto px-4 md:px-6 max-w-7xl">
                <div class="text-center space-y-4 mb-12">
                    <h2 class="text-3xl font-bold tracking-tighter sm:text-4xl md:text-5xl text-navy-blue">Fitur Utama</h2>
                    <p class="text-lg text-gray-600 max-w-[800px] mx-auto">
                        Solusi komprehensif untuk manajemen perizinan kendaraan yang efisien dan aman
                    </p>
                </div>
                <div class="grid gap-8 sm:grid-cols-2 lg:grid-cols-3 justify-items-center">
                    @foreach ([
                        [
                            'title' => 'Manajemen Perizinan',
                            'content' => 'Proses perizinan kendaraan yang efisien dan terstruktur untuk kelancaran lalu lintas di gerbang tol.',
                            'icon' => 'check-square',
                            'gradient' => 'from-green-500 to-green-600'
                        ],
                        [
                            'title' => 'Verifikasi Real-time',
                            'content' => 'Sistem verifikasi cepat dan akurat untuk memastikan keabsahan izin kendaraan yang melintas.',
                            'icon' => 'shield-check',
                            'gradient' => 'from-yellow-400 to-yellow-500'
                        ],
                        [
                            'title' => 'Pelaporan & Analisis',
                            'content' => 'Laporan komprehensif dan analisis data untuk pengambilan keputusan yang lebih baik.',
                            'icon' => 'bar-chart-2',
                            'gradient' => 'from-green-500 to-green-600'
                        ]
                    ] as $feature)
                        <div class="card-hover w-full max-w-sm rounded-xl bg-white p-8 shadow-lg border border-gray-200">
                            <div class="flex flex-col space-y-4">
                                <div class="inline-flex h-12 w-12 items-center justify-center rounded-lg bg-gradient-to-br {{ $feature['gradient'] }}">
                                    <i data-lucide="{{ $feature['icon'] }}" class="h-6 w-6 text-white"></i>
                                </div>
                                <h3 class="text-xl font-semibold text-navy-blue">{{ $feature['title'] }}</h3>
                                <p class="text-gray-600">{{ $feature['content'] }}</p>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>

        <section id="tentang" class="w-full py-16 md:py-24 lg:py-32 bg-gray-50">
            <div class="container mx-auto px-4 md:px-6 max-w-7xl">
                <div class="grid gap-12 lg:grid-cols-2 lg:gap-16 items-center">
                    <div class="relative group">
                        <div class="absolute -inset-4 rounded-xl bg-gradient-to-r from-green-500 to-yellow-400 opacity-20 blur-lg transition-all duration-500 group-hover:opacity-40"></div>
                        <img src="{{ asset('images/GambarTol.jpeg') }}" alt="Gerbang Tol PT Trans Marga Jateng" class="relative w-full rounded-xl shadow-2xl transition-transform duration-500 group-hover:scale-[1.02]">
                    </div>
                    <div class="flex flex-col justify-center space-y-6">
                        <h2 class="text-3xl font-bold tracking-tighter sm:text-4xl text-navy-blue">Tentang Tertib Lolos</h2>
                        <p class="text-lg text-gray-600">
                            Tertib Lolos adalah sistem manajemen perizinan kendaraan inovatif yang dikembangkan oleh PT Trans Marga Jateng.
                            Dirancang untuk mengoptimalkan alur lalu lintas di gerbang tol, sistem ini menjamin keamanan, efisiensi, dan
                            keteraturan dalam proses perizinan kendaraan yang melintas.
                        </p>
                        <div class="grid gap-4 sm:grid-cols-2">
                            <div class="flex items-center space-x-3">
                                <div class="rounded-full bg-green-100 p-2">
                                    <i data-lucide="check" class="h-5 w-5 text-green-600"></i>
                                </div>
                                <span class="text-navy-blue font-medium">Efisien</span>
                            </div>
                            <div class="flex items-center space-x-3">
                                <div class="rounded-full bg-green-100 p-2">
                                    <i data-lucide="shield" class="h-5 w-5 text-green-600"></i>
                                </div>
                                <span class="text-navy-blue font-medium">Aman</span>
                            </div>
                            <div class="flex items-center space-x-3">
                                <div class="rounded-full bg-green-100 p-2">
                                    <i data-lucide="clock" class="h-5 w-5 text-green-600"></i>
                                </div>
                                <span class="text-navy-blue font-medium">Real-time</span>
                            </div>
                            <div class="flex items-center space-x-3">
                                <div class="rounded-full bg-green-100 p-2">
                                    <i data-lucide="trending-up" class="h-5 w-5 text-green-600"></i>
                                </div>
                                <span class="text-navy-blue font-medium">Terukur</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section id="kontak" class="w-full py-16 md:py-24 lg:py-32 bg-white">
            <div class="container mx-auto px-4 md:px-6 max-w-7xl">
                <div class="text-center space-y-4 mb-12">
                    <h2 class="text-3xl font-bold tracking-tighter sm:text-4xl md:text-5xl text-navy-blue">Hubungi Kami</h2>
                    <p class="text-lg text-gray-600 max-w-[600px] mx-auto">
                        Kami siap membantu Anda dengan segala pertanyaan tentang Tertib Lolos
                    </p>
                </div>
                <div class="grid gap-8 lg:grid-cols-2 lg:gap-12 items-start">
                    <div class="space-y-6 p-6 rounded-xl bg-gray-50">
                        <div class="flex items-start space-x-4 group">
                            <div class="rounded-lg bg-white p-3 shadow-sm transition-colors group-hover:bg-navy-blue">
                                <i data-lucide="map-pin" class="h-6 w-6 text-navy-blue transition-colors group-hover:text-white"></i>
                            </div>
                            <div class="space-y-1">
                                <h3 class="font-medium text-navy-blue">Alamat</h3>
                                <p class="text-gray-600">Jl Mulawarman Raya No.1B RT.002 RW.004 Kel. Pedalangan Kec.Banyumanik Semarang, Jawa Tengah 50268</p>
                            </div>
                        </div>
                        <div class="flex items-start space-x-4 group">
                            <div class="rounded-lg bg-white p-3 shadow-sm transition-colors group-hover:bg-navy-blue">
                                <i data-lucide="phone" class="h-6 w-6 text-navy-blue transition-colors group-hover:text-white"></i>
                            </div>
                            <div class="space-y-1">
                                <h3 class="font-medium text-navy-blue">Telepon</h3>
                                <p class="text-gray-600">+62 24 1234 5678</p>
                            </div>
                        </div>
                        <div class="flex items-start space-x-4 group">
                            <div class="rounded-lg bg-white p-3 shadow-sm transition-colors group-hover:bg-navy-blue">
                                <i data-lucide="mail" class="h-6 w-6 text-navy-blue transition-colors group-hover:text-white"></i>
                            </div>
                            <div class="space-y-1">
                                <h3 class="font-medium text-navy-blue">Email</h3>
                                <p class="text-gray-600">admin@transmargajateng.com</p>
                            </div>
                        </div>
                    </div>
                    <div class="relative rounded-xl overflow-hidden h-[400px]">
                        <iframe
                            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3959.6295811908483!2d110.42340661477567!3d-7.052866994915436!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e708c0ea49270a7%3A0x4027a76e352e4a0!2sJl.%20Mulawarman%20Raya%20No.1B%2C%20Kramas%2C%20Kec.%20Tembalang%2C%20Kota%20Semarang%2C%20Jawa%20Tengah%2050268!5e0!3m2!1sen!2sid!4v1635134567890!5m2!1sen!2sid"
                            width="100%"
                            height="100%"
                            style="border:0;"
                            allowfullscreen=""
                            loading="lazy"
                            referrerpolicy="no-referrer-when-downgrade"
                            class="absolute inset-0"
                        ></iframe>
                    </div>
                </div>
            </div>
        </section>
    </main>

    <footer class="w-full py-8 bg-navy-blue text-white">
        <div class="container mx-auto px-4 md:px-6 max-w-7xl">
            <div class="grid gap-8 lg:grid-cols-2">
                <div class="space-y-4">
                    <div class="flex items-center space-x-2">
                        <img src="{{ asset('images/GambarTMJ.jpg') }}" alt="Tertib Lolos Logo" class="h-10 w-auto" width="80" height="60">
                        <span class="text-xl font-bold">Tertib Lolos</span>
                    </div>
                    <p class="text-sm text-gray-300 max-w-md">
                        Sistem manajemen perizinan kendaraan pintar untuk kelancaran lalu lintas di gerbang tol PT Trans Marga Jateng.
                    </p>
                </div>
                <div class="grid grid-cols-2 gap-8 sm:grid-cols-3">
                    <div>
                        <h3 class="text-sm font-semibold uppercase tracking-wider">Navigasi</h3>
                        <div class="mt-4 space-y-2">
                            <a href="#tentang" class="block text-sm text-gray-300 hover:text-white">Tentang</a>
                            <a href="#fitur" class="block text-sm text-gray-300 hover:text-white">Fitur</a>
                            <a href="#kontak" class="block text-sm text-gray-300 hover:text-white">Kontak</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="mt-8 border-t border-gray-700 pt-8">
                <p class="text-sm text-gray-300">
                    © {{ date('Y') }} Tertib Lolos - PT Trans Marga Jateng. Hak Cipta Dilindungi.
                </p>
            </div>
        </div>
    </footer>

    <script>
        lucide.createIcons();
    </script>
</body>
</html>
