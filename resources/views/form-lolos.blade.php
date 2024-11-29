<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <style>
        @media print {
            body {
                font-family: Arial, sans-serif;
                font-size: 10pt;
                margin: 0;
                padding: 0;
            }

            h2, p {
                text-align: center;
                font-size: 12pt;
                margin-bottom: 5px;
            }

            table {
                width: 100%;
                border-collapse: collapse;
                margin-top: 20px;
            }

            th, td {
                border: 1px solid #000;
                padding: 6px;
                text-align: center;
            }

            th {
                background-color: #f0f0f0;
                font-weight: bold;
            }

            /* Sembunyikan elemen navigasi dan tombol */
            a, button {
                display: none !important;
            }

            /* Hapus shadow dan background */
            .shadow {
                box-shadow: none !important;
            }

            .bg-white {
                background-color: #fff !important;
            }

            .rounded-lg {
                border-radius: 0 !important;
            }

            /* Tanda tangan section */
            .signature-section {
                margin-top: 30px;
                text-align: center;
                font-size: 11pt;
            }

            .signature-section p {
                margin-top: 40px;
            }

            .footer {
                text-align: center;
                margin-top: 20px;
                font-size: 10pt;
            }
        }

        /* Normal styles */
        body {
            font-family: Arial, sans-serif;
        }

        .flex {
            display: flex;
            justify-content: flex-end;
        }

        .bg-blue-500 {
            background-color: #3b82f6;
        }

        .text-white {
            color: #fff;
        }

        .px-4, .py-2 {
            padding-left: 1rem;
            padding-right: 1rem;
            padding-top: 0.5rem;
            padding-bottom: 0.5rem;
        }

        .rounded {
            border-radius: 0.375rem;
        }

        .hover\:bg-blue-600:hover {
            background-color: #2563eb;
        }
    </style>
</head>
<body>
    <div class="bg-white shadow rounded-lg p-6">
        <h2 class="text-xl font-bold text-center">FORM LOLOS/IZIN LINTAS</h2>
        <p class="text-center">Gerbang Tol: <span>...............................</span></p>
        <p class="text-center">Tanggal: <span>...............................</span></p>
        <hr class="my-4">

        <!-- Tombol Print -->
        <div class="flex justify-end mb-4">
            <button onclick="printPage()" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">
                Print Halaman
            </button>
        </div>

        <!-- Tabel Data -->
        <table class="w-full border-collapse border border-gray-300 text-sm">
            <thead>
                <tr class="bg-gray-100">
                    <th class="border border-gray-300 px-2 py-1">No</th>
                    <th class="border border-gray-300 px-2 py-1">Pukul</th>
                    <th class="border border-gray-300 px-2 py-1">Gardu</th>
                    <th class="border border-gray-300 px-2 py-1">Nomor Resi Awal</th>
                    <th class="border border-gray-300 px-2 py-1">Nomor Resi Akhir</th>
                    <th class="border border-gray-300 px-2 py-1">Jumlah Kendaraan</th>
                    <th class="border border-gray-300 px-2 py-1">Gol Kendaraan</th>
                    <th class="border border-gray-300 px-2 py-1">Instansi</th>
                    <th class="border border-gray-300 px-2 py-1">Penanggung Jawab</th>
                    <th class="border border-gray-300 px-2 py-1">Surat Izin</th>
                </tr>
            </thead>
            <tbody>
                <!-- Loop data -->
                @foreach($data as $key => $item)
                <tr>
                    <td class="border border-gray-300 px-2 py-1">{{ (int)$key + 1 }}</td>
                    <td class="border border-gray-300 px-2 py-1">{{ is_object($item) ? $item->pukul : '' }}</td>
                    <td class="border border-gray-300 px-2 py-1">{{ is_object($item) && property_exists($item, 'gardu') ? $item->gardu : '' }}</td>
                    <td class="border border-gray-300 px-2 py-1">{{ is_object($item) && property_exists($item, 'nomor_resi_awal') ? $item->nomor_resi_awal : '' }}</td>
                    <td class="border border-gray-300 px-2 py-1">{{ is_object($item) && property_exists($item, 'nomor_resi_akhir') ? $item->nomor_resi_akhir : '' }}</td>
                    <td class="border border-gray-300 px-2 py-1">{{ is_object($item) && property_exists($item, 'jumlah_kendaraan') ? $item->jumlah_kendaraan : '' }}</td>
                    <td class="border border-gray-300 px-2 py-1">{{ is_object($item) && property_exists($item, 'gol_kendaraan') ? $item->gol_kendaraan : '' }}</td>
                    <td class="border border-gray-300 px-2 py-1">{{ is_object($item) && property_exists($item, 'instansi') ? $item->instansi : '' }}</td>
                    <td class="border border-gray-300 px-2 py-1">{{ is_object($item) && property_exists($item, 'penanggung_jawab') ? $item->penanggung_jawab : '' }}</td>
                    <td class="border border-gray-300 px-2 py-1">{{ is_object($item) && property_exists($item, 'surat_izin') ? ($item->surat_izin ? 'Ya' : 'Tidak') : '' }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>

        <!-- Tanda tangan -->
        <div class="signature-section">
            <p>Customer Service Supervisor: ........................................</p>
            <p>Assistant Manager Transaction: .......................................</p>
        </div>

        <div class="footer">
            <p>&copy; 2024 Form Lolos/Izin Lintas. All rights reserved.</p>
        </div>
    </div>

    <!-- Tambahkan script JavaScript untuk print -->
    <script>
        function printPage() {
            // Sembunyikan elemen navigasi dan tombol
            const elementsToHide = document.querySelectorAll('button');
            elementsToHide.forEach(el => el.style.display = 'none');

            // Cetak halaman
            window.print();

            // Kembalikan elemen setelah cetak
            elementsToHide.forEach(el => el.style.display = '');
        }
    </script>
</body>
</html>
