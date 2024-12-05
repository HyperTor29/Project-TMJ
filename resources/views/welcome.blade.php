<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>PT Trans Marga Jateng</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <script src="https://unpkg.com/lucide@latest"></script>
    <style>
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
    </style>
</head>
<body class="flex flex-col min-h-screen bg-white">
    <header class="sticky top-0 z-50 w-full border-b bg-white shadow-sm">
        <div class="container mx-auto flex h-16 items-center px-4">
            <a href="{{ url('/') }}" class="flex items-center space-x-2">
                <img src="{{ asset('images/GambarTMJ.jpg') }}" alt="PT Trans Marga Jateng Logo" class="h-10" width="80" height="60">
            </a>
            <nav class="ml-auto flex gap-4 sm:gap-6 items-center">
                <a class="text-sm font-medium text-navy-blue hover:text-green-600" href="#tentang">Tentang</a>
                <a class="text-sm font-medium text-navy-blue hover:text-green-600" href="#layanan">Layanan</a>
                <a class="text-sm font-medium text-navy-blue hover:text-green-600" href="#kontak">Kontak</a>
                <a href="#" onclick="showRoleSelector()" class="inline-flex items-center justify-center rounded-md text-sm font-medium ring-offset-background transition-colors focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 disabled:pointer-events-none disabled:opacity-50 border border-input bg-background hover:bg-accent hover:text-accent-foreground h-10 px-4 py-2 border-navy-blue text-navy-blue hover:bg-navy-blue hover:text-white">
                    Masuk
                </a>

                <div id="role-selector" class="hidden absolute bg-white border p-4 rounded shadow-md mt-2 w-56">
                    <label for="role" class="block text-sm font-medium text-gray-700">Pilih Peran</label>
                    <select id="role" class="w-full p-2 border border-gray-300 rounded">
                        <option value="admin">Admin</option>
                        <option value="user">User</option>
                        <option value="verificator">Verificator</option>
                        <option value="validator">Validator</option>
                        <option value="viewer">Viewer</option>
                    </select>
                    <button onclick="redirectToLogin()" class="mt-4 w-full bg-navy-blue text-white px-4 py-2 rounded">Masuk</button>
                </div>

                <script>
                    function showRoleSelector() {
                        document.getElementById('role-selector').classList.toggle('hidden');
                    }

                    function redirectToLogin() {
                        var role = document.getElementById('role').value;
                        var url = '';

                        switch (role) {
                            case 'admin':
                                url = 'http://127.0.0.1:8000/admin/login';
                                break;
                            case 'user':
                                url = 'http://127.0.0.1:8000/user/login';
                                break;
                            case 'verificator':
                                url = 'http://127.0.0.1:8000/verificator/login';
                                break;
                            case 'validator':
                                url = 'http://127.0.0.1:8000/validator/login';
                                break;
                            case 'viewer':
                                url = 'http://127.0.0.1:8000/viewer/login';
                                break;
                        }

                        window.location.href = url;
                    }
                </script>
            </nav>
        </div>
    </header>

    <main class="flex-1">
        <section class="w-full py-12 md:py-24 lg:py-32 xl:py-48 bg-gradient-to-r from-green-500 via-yellow-400 to-green-500">
            <div class="container mx-auto px-4 md:px-6 max-w-7xl">
                <div class="flex flex-col items-center space-y-4 text-center">
                    <div class="space-y-2 max-w-3xl mx-auto">
                        <h1 class="text-3xl font-bold tracking-tighter sm:text-4xl md:text-5xl lg:text-6xl/none text-navy-blue">
                            Selamat Datang di PT Trans Marga Jateng
                        </h1>
                        <p class="mx-auto max-w-[700px] text-navy-blue md:text-xl">
                            Menghubungkan Jawa Tengah melalui infrastruktur transportasi yang berkelanjutan dan inovatif.
                        </p>
                    </div>
                    <a href="#kontak" class="inline-flex items-center justify-center rounded-md text-sm font-medium ring-offset-background transition-colors focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 disabled:pointer-events-none disabled:opacity-50 bg-primary text-primary-foreground hover:bg-primary/90 h-10 px-4 py-2 bg-navy-blue text-white hover:bg-blue-800">Hubungi Kami</a>
                </div>
            </div>
        </section>

        <section id="layanan" class="w-full py-12 md:py-24 lg:py-32 bg-white">
            <div class="container mx-auto px-4 md:px-6 max-w-7xl">
                <h2 class="text-3xl font-bold tracking-tighter sm:text-4xl md:text-5xl mb-8 text-center text-navy-blue">Layanan Kami</h2>
                <div class="grid gap-6 sm:grid-cols-2 lg:grid-cols-3 justify-items-center">
                    @foreach ([
                        ['title' => 'Pengelolaan Jalan Tol', 'content' => 'Pengelolaan dan pemeliharaan jalan tol yang efisien di seluruh Jawa Tengah.', 'border' => 'border-green-500'],
                        ['title' => 'Pengembangan Infrastruktur', 'content' => 'Perencanaan dan pelaksanaan proyek infrastruktur transportasi baru.', 'border' => 'border-yellow-400'],
                        ['title' => 'Manajemen Lalu Lintas', 'content' => 'Sistem canggih untuk kelancaran arus lalu lintas dan peningkatan keselamatan jalan.', 'border' => 'border-green-500']
                    ] as $service)
                        <div class="w-full max-w-sm rounded-lg border bg-card text-card-foreground shadow-sm {{ $service['border'] }}">
                            <div class="flex flex-col space-y-1.5 p-6">
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
                    <img src="{{ asset('images/GambarTol.jpeg') }}" alt="Tentang PT Trans Marga Jateng" class="mx-auto aspect-video overflow-hidden rounded-xl object-cover object-center sm:w-full lg:order-last">
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
                            <span style="display: block;">Jl Mulawarman Raya No.1B RT.002 RW.004 Kel. Pedalangan Kec.Banyumanik Semarang, Jawa Tengah 50268</span>
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
