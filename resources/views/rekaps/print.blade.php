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

            /* Add page numbers using CSS counters */
            @bottom-right {
                content: counter(page);
                font-size: 12px;
                font-family: Arial, sans-serif;
                margin-top: 30px;
            }
        }

        /* Add counter reset for pages */
        body {
            counter-reset: page;
            font-family: Arial, sans-serif;
            line-height: 1.6;
            margin: 0;
            padding: 0;
            color: #333;
        }

        /* Add page break and counter increment for each page */
        .page {
            page-break-after: always;
            counter-increment: page;
        }

        .container {
            max-width: 100%;
            margin: 0 auto;
            padding: 20px;
        }

        .header {
            position: relative;
            display: flex;
            align-items: center;
            margin-bottom: 30px;
            border-bottom: 2px solid #333;
            padding-bottom: 20px;
        }

        .logo {
            width: 80px;
            height: auto;
            position: absolute;
            left: 0;
            top: 0;
        }

        .header-text {
            flex-grow: 1;
            text-align: center;
        }

        .header h1 {
            font-size: 24px;
            font-weight: bold;
            margin: 0;
            padding: 10px 0;
            letter-spacing: 1px;
        }

        .content-section {
            margin-bottom: 30px;
        }

        .toll-gate {
            text-align: center;
            margin: 20px 0;
            font-size: 16px;
            font-weight: bold;
            padding: 10px;
            background-color: #f8f8f8;
            border-radius: 4px;
        }

        .date-section {
            margin: 20px 0;
            line-height: 1.8;
        }

        .personnel-info {
            margin: 25px 0;
        }

        .personnel-item {
            margin-bottom: 15px;
            padding-left: 20px;
        }

        .main-table {
            width: 100%;
            border-collapse: collapse;
            margin: 25px 0;
            font-size: 12px;
            background-color: #fff;
        }

        .main-table th,
        .main-table td {
            border: 1px solid #333;
            padding: 10px;
            text-align: left;
        }

        .main-table th {
            background-color: #f4f4f4;
            font-weight: bold;
        }

        .main-table tr:nth-child(even) {
            background-color: #f9f9f9;
        }

        .total-row {
            font-weight: bold;
            background-color: #f4f4f4;
        }

        .signatures {
            display: grid;
            grid-template-areas:
                "supervisor . service"
                ". manager .";
            grid-template-columns: 1fr 1fr 1fr;
            gap: 30px;
            margin-top: 50px;
            page-break-inside: avoid;
        }

        .signature-box {
            text-align: center;
            width: 200px;
            margin: 0 auto;
            padding: 15px;
            border: 1px solid #eee;
            border-radius: 4px;
        }

        .signature-title {
            margin-bottom: 70px;
            font-weight: bold;
            color: #444;
        }

        .signature-name {
            margin-bottom: 5px;
            font-weight: bold;
        }

        .signature-line {
            border-bottom: 1px solid #333;
            width: 200px;
            margin: 10px auto;
        }

        .signature-nik {
            margin-top: 5px;
            color: #666;
        }

        .lampiran {
            margin-top: 40px;
            page-break-before: always;
        }

        .lampiran h3 {
            text-align: center;
            font-size: 18px;
            font-weight: bold;
            margin-bottom: 30px;
            padding-bottom: 10px;
            border-bottom: 2px solid #333;
        }

        .photo-attachments {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 20px;
            margin-top: 30px;
        }

        .photo-item {
            text-align: center;
        }

        .photo-item img {
            width: 100%;
            max-width: 300px;
            height: auto;
            object-fit: cover;
            border: 1px solid #ddd;
            border-radius: 4px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }

        .photo-number {
            margin-top: 10px;
            font-size: 14px;
            color: #666;
        }

        .print-button {
            text-align: right;
            margin-top: 30px;
        }

        .print-button button {
            padding: 10px 20px;
            background-color: #007bff;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 14px;
        }

        .print-button button:hover {
            background-color: #0056b3;
        }

        @media print {
            .print-button {
                display: none;
            }

            body {
                -webkit-print-color-adjust: exact;
                print-color-adjust: exact;
            }
        }
        /* Ensure last page doesn't have unnecessary page break */
        .container:last-child {
            page-break-after: avoid;
        }
    </style>
</head>
<body>
    <div class="container page">
        <div class="header">
        <img src="{{ asset('images/GambarTMJ.jpg') }}" alt="Tertib Lolos Logo" class="h-10 w-auto" width="80" height="50">
            <div class="header-text">
                <h1>FORM LOLOS/ IZIN LINTAS</h1>
            </div>
        </div>

        <div class="content-section">
            <div class="toll-gate" style="text-align: center; margin-top: 10px;">
                Gerbang Tol: {{ $form->GerbangTujuan->name ?? '........................' }}
            </div>

            <div class="date-section">
                Pada hari ini {{ \Carbon\Carbon::parse($form->tanggal)->locale('id')->isoFormat('dddd') }}
                tanggal {{ \Carbon\Carbon::parse($form->tanggal)->locale('id')->isoFormat('D') }}
                bulan {{ \Carbon\Carbon::parse($form->tanggal)->locale('id')->isoFormat('MMMM') }}
                tahun {{ \Carbon\Carbon::parse($form->tanggal)->isoFormat('YYYY') }}<br>
                yang bertanda tangan dibawah ini:
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
                <div class="personnel-item">
                    4. Nama    : {{ $form->DataSecurity->nama ?? '........................' }}<br>
                       NIK     : {{ $form->DataSecurity->nik ?? '........................' }}<br>
                       Jabatan : {{ $form->DataSecurity->jabatan ?? '........................' }}
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
    </div>

    <div class="lampiran page">
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
</body>
</html>

