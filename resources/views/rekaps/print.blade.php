<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Lolos/Izin Lintas</title>
    <style>
        @page {
            margin: 2.5cm;
            size: A4;
        }

        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 100%;
            margin: 0 auto;
            padding: 20px;
        }

        .header {
            text-align: center;
            margin-bottom: 20px;
        }

        .header h1 {
            font-size: 18px;
            font-weight: bold;
            margin: 0;
            padding: 10px 0;
        }

        .content-section {
            margin-bottom: 20px;
        }

        .main-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
            font-size: 12px;
        }

        .main-table th,
        .main-table td {
            border: 1px solid #000;
            padding: 8px;
            text-align: left;
        }

        .main-table th {
            background-color: #fff;
            font-weight: normal;
        }

        .total-row {
            font-weight: bold;
        }

        /* Updated signatures section */
        .signatures {
            display: grid;
            grid-template-areas:
                "supervisor . service"
                ". manager .";
            grid-template-columns: 1fr 1fr 1fr;
            gap: 20px;
            margin-top: 30px;
            page-break-inside: avoid;
        }

        .signature-box {
            text-align: center;
            width: 200px;
            margin: 0 auto;
        }

        .signature-box.supervisor {
            grid-area: supervisor;
        }

        .signature-box.service {
            grid-area: service;
        }

        .signature-box.manager {
            grid-area: manager;
        }

        .signature-title {
            margin-bottom: 60px;
        }

        .signature-name {
            margin-bottom: 0;
        }

        .signature-line {
            border-bottom: 1px solid #000;
            width: 200px;
            margin: 0 auto;
        }

        .signature-nik {
            margin-top: 5px;
        }

        /* Print specific styles */
        @media print {
            .page-break {
                page-break-before: always;
            }

            .print-button {
                display: none;
            }

            .main-table {
                page-break-inside: auto;
            }

            .main-table tr {
                page-break-inside: avoid;
            }

            .signatures {
                margin-top: 50px;
            }

            /* Style for the photo attachments */
            .lampiran {
                margin-top: 30px;
                page-break-before: always;
            }

            .lampiran h3 {
                text-align: center;
                font-size: 16px;
                font-weight: bold;
                margin-bottom: 20px;
            }

            .photo-attachments {
                display: flex;
                flex-wrap: wrap;
                justify-content: space-around;
                margin-top: 20px;
            }

            .photo-attachments img {
                width: 200px;
                height: 200px;
                object-fit: cover;
                margin: 5px;
                border: 1px solid #000;
                border-radius: 5px;
            }

            .photo-number {
                text-align: center;
                margin-top: 5px;
            }
        }

        .print-button {
            text-align: right;
            margin-top: 20px;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>FORM LOLOS/ IZIN LINTAS</h1>
        </div>

        <div class="content-section">
            <div class="toll-gate">
                Gerbang Tol: {{ $form->Gerbang->name ?? '........................' }}
            </div>

            <div class="date-section">
                Pada hari ini {{ \Carbon\Carbon::parse($form->tanggal)->locale('id')->isoFormat('dddd') }}
                tanggal {{ \Carbon\Carbon::parse($form->tanggal)->locale('id')->isoFormat('D') }}
                bulan {{ \Carbon\Carbon::parse($form->tanggal)->locale('id')->isoFormat('MMMM') }}
                tahun {{ \Carbon\Carbon::parse($form->tanggal)->isoFormat('YYYY') }}<br>
                bertanda tangan dibawah ini:
            </div>

            <div class="personnel-info">
                <div class="personnel-item">
                    1. Nama    : {{ $form->DataCs->nama ?? '........................' }}<br>
                       NIK     : {{ $form->DataCs->nik ?? '........................' }}<br>
                       Jabatan : {{ $form->DataCs->jabatan ?? '........................' }}
                </div>
                <div class="personnel-item">
                    2. Nama    : {{ $form->DataCss->nama ?? '........................' }}<br>
                       NIK     : {{ $form->DataCss->nik ?? '........................' }}<br>
                       Jabatan : {{ $form->DataCss->jabatan ?? '........................' }}
                </div>
                <div class="personnel-item">
                    3. Nama    : {{ $form->Asmen->nama ?? '........................' }}<br>
                       NIK     : {{ $form->Asmen->nik ?? '........................' }}<br>
                       Jabatan : {{ $form->Asmen->jabatan ?? '........................' }}
                </div>
            </div>

            <div class="shift-info">
                Menerangkan bahwa pada Shift {{ $form->Shifts->shift ?? '........................' }} Telah terjadi Lolos/Izin Lintas Kendaraan sebagai berikut:
            </div>
        </div>

        <table class="main-table">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Pukul</th>
                    <th>Gardu</th>
                    <th>Nomor Resi Awal</th>
                    <th>Nomor Resi Akhir</th>
                    <th>Gerbang Asal</th>
                    <th>Jumlah Kendaraan</th>
                    <th>Gol. Kendaraan</th>
                    <th>Nomor Kendaraan</th>
                    <th>Instansi</th>
                    <th>Nama Penanggung Jawab</th>
                </tr>
            </thead>
            <tbody>
                @foreach($detailLolos as $index => $detail)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $detail->pukul }}</td>
                    <td>{{ $detail->Gardu->gardu ?? '-' }}</td>
                    <td>{{ $detail->nomor_resi_awal ?? '-' }}</td>
                    <td>{{ $detail->nomor_resi_akhir ?? '-' }}</td>
                    <td>{{ $detail->Gerbang->name ?? '-' }}</td>
                    <td>{{ $detail->jumlah_kdr ?? '-' }}</td>
                    <td>{{ $detail->GolKdr->golongan ?? '-' }}</td>
                    <td>{{ $detail->nomor_kendaraan ?? '-' }}</td>
                    <td>{{ $detail->Instansi->instansi ?? '-' }}</td>
                    <td>{{ $detail->penanggung_jawab ?? '-' }}</td>
                </tr>
                @endforeach
                <tr class="total-row">
                    <td colspan="6">Total Kendaraan</td>
                    <td colspan="5">{{ $detailLolos->sum('jumlah_kdr') }}</td>
                </tr>
            </tbody>
        </table>

        <div class="signatures">
            <div class="signature-box supervisor">
                <div class="signature-title">Customer Service Supervisor</div>
                <div class="signature-name">{{ $form->DataCss->nama ?? '' }}</div>
                <div class="signature-line"></div>
                <div class="signature-nik">NIK. {{ $form->DataCss->nik ?? '' }}</div>
            </div>

            <div class="signature-box service">
                <div class="signature-title">Customer Service</div>
                <div class="signature-name">{{ $form->DataCs->nama ?? '' }}</div>
                <div class="signature-line"></div>
                <div class="signature-nik">NIK. {{ $form->DataCs->nik ?? '' }}</div>
            </div>

            <div class="signature-box manager">
                <div class="signature-title">Asmen Lalu Lintas</div>
                <div class="signature-name">{{ $form->Asmen->nama ?? '' }}</div>
                <div class="signature-line"></div>
                <div class="signature-nik">NIK. {{ $form->Asmen->nik ?? '' }}</div>
            </div>
        </div>

        <!-- Lampiran Section -->
        <div class="lampiran">
            <h3>LAMPIRAN</h3>
            <div class="photo-attachments">
                @foreach($detailLolos as $index => $detail)
                    <!-- Foto Surat -->
                    @if ($detail->surats->isNotEmpty())
                        @foreach ($detail->surats as $surat)
                            <div class="photo-item">
                                <img src="{{ asset('storage/' . $surat->surat) }}" alt="Foto Surat">
                                <div class="photo-number">Nomor {{ $index + 1 }}: Foto Surat</div>
                            </div>
                        @endforeach
                    @endif

                    <!-- Foto Kendaraan -->
                    @if ($detail->fotos->isNotEmpty())
                        @foreach ($detail->fotos as $foto)
                            <div class="photo-item">
                                <img src="{{ asset('storage/' . $foto->foto) }}" alt="Foto Kendaraan">
                                <div class="photo-number">Nomor {{ $index + 1 }}: Foto Kendaraan</div>
                            </div>
                        @endforeach
                    @endif
                @endforeach
            </div>
        </div>

        <div class="print-button">
            <button onclick="window.print()">Print</button>
        </div>
    </div>
</body>
</html>
