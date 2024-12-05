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

        .toll-gate {
            margin-bottom: 15px;
        }

        .date-section {
            margin-bottom: 20px;
        }

        .personnel-info {
            margin-bottom: 20px;
        }

        .personnel-item {
            margin-bottom: 10px;
        }

        .personnel-item span {
            display: inline-block;
            min-width: 100px;
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

        .signatures {
            display: flex;
            justify-content: space-between;
            margin-top: 50px;
            page-break-inside: avoid;
        }

        .signature-box {
            text-align: center;
            width: 200px;
        }

        .signature-line {
            border-bottom: 1px solid #000;
            margin: 50px 0 10px 0;
        }

        @media print {
            body {
                width: 100%;
                margin: 0;
                padding: 0;
            }

            .container {
                width: 100%;
                padding: 0;
            }

            .main-table {
                page-break-inside: avoid;
            }

            .signatures {
                margin-top: 30px;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>FORM LOLOS/ IZIN LINTAS</h1>
        </div>

        <div class="toll-gate">
            Gerbang Tol: {{ $form->Gerbang->name ?? '........................' }}
        </div>

        <div class="date-section">
            Pada hari ini {{ \Carbon\Carbon::parse($form->tanggal)->isoFormat('dddd') }}
            Tanggal {{ \Carbon\Carbon::parse($form->tanggal)->isoFormat('D') }}
            Bulan {{ \Carbon\Carbon::parse($form->tanggal)->isoFormat('MMMM') }}
            Tahun {{ \Carbon\Carbon::parse($form->tanggal)->isoFormat('YYYY') }}<br>
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
                    <td colspan="5">Total Kendaraan</td>
                    <td colspan="7">{{ $detailLolos->sum('jumlah_kdr') }}</td>
                </tr>
            </tbody>
        </table>

        <div class="signatures">
            <div class="signature-box">
                <div>Customer Service Supervisor</div>
                <div>{{ $form->DataCss->nama ?? '' }}</div>
                <div class="signature-line"></div>
                <div>NIK. {{ $form->DataCss->nik ?? '' }}</div>
            </div>

            <div class="signature-box">
                <div>Customer Service</div>
                <div>{{ $form->DataCs->nama ?? '' }}</div>
                <div class="signature-line"></div>
                <div>NIK. {{ $form->DataCs->nik ?? '' }}</div>
            </div>

            <div class="signature-box">
                <div>Assistant Manager<br>Transaction</div>
                <div>{{ $form->Asmen->nama ?? '' }}</div>
                <div class="signature-line"></div>
                <div>NIK. {{ $form->Asmen->nik ?? '' }}</div>
            </div>
        </div>
    </div>
</body>
</html>

