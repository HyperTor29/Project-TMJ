<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }
        .container {
            width: 100%;
            padding: 10px;
            background-color: #fff;
        }
        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
        }
        h2 {
            font-size: 24px;
            font-weight: bold;
            text-align: center;
            margin: 0;
        }
        .logo img {
            width: 150px;
            height: auto;
        }
        .date-info {
            text-align: right;
        }
        table {
            width: 100%;
            margin-top: 20px;
            border-collapse: collapse;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
            font-size: 14px;
        }
        th {
            background-color: #f2f2f2;
        }
        .section-title {
            font-size: 18px;
            font-weight: bold;
            margin-top: 20px;
        }
        .btn-print {
            margin-top: 20px;
            text-align: right;
        }
        .btn-print button {
            padding: 8px 16px;
            background-color: #4CAF50;
            color: white;
            border: none;
            cursor: pointer;
        }
        .btn-print button:hover {
            background-color: #45a049;
        }
        .signature-section {
            margin-top: 30px;
            display: flex;
            justify-content: space-between;
            text-align: center;
        }
        .signature-box {
            width: 200px;
            height: 50px;
            border-top: 1px solid black;
            margin-top: 40px;
            text-align: center;
            line-height: 40px;
        }
        .signature-label {
            font-size: 14px;
            margin-top: 10px;
        }
        @media print {
            .btn-print {
                display: none;
            }
            body {
                margin: 0;
                padding: 0;
            }
            @page {
                margin: 0;
                size: auto;
            }
            .container {
                padding: 10px;
                width: 100%;
            }
        }
    </style>
</head>
<body>

<div class="container">
    <div class="header">
        <div class="logo">
            <img src="logo.png" alt="Logo">
        </div>
        <div class="date-info">
            <p>Semarang, {{ date('d F Y') }}</p>
        </div>
    </div>

    <h2>FORM LOLOS/IZIN LINTAS</h2>

    <!-- Informasi Petugas -->
    <div class="section-title">Informasi Petugas</div>
    <table>
        <tr>
            <th>Tanggal</th>
            <td>{{ $form->tanggal ?? '-' }}</td>
        </tr>
        <tr>
            <th>Shift</th>
            <td>{{ $form->Shifts->shift ?? '-' }}</td>
        </tr>
        <tr>
            <th>Nama CS</th>
            <td>{{ $form->DataCs->nama ?? '-' }}</td>
        </tr>
        <tr>
            <th>NIK CS</th>
            <td>{{ $form->DataCs->nik ?? '-' }}</td>
        </tr>
        <tr>
            <th>Jabatan CS</th>
            <td>{{ $form->DataCs->jabatan ?? '-' }}</td>
        </tr>
        <tr>
            <th>Nama CSS</th>
            <td>{{ $form->DataCss->nama ?? '-' }}</td>
        </tr>
        <tr>
            <th>NIK CSS</th>
            <td>{{ $form->DataCss->nik ?? '-' }}</td>
        </tr>
        <tr>
            <th>Jabatan CSS</th>
            <td>{{ $form->DataCss->jabatan ?? '-' }}</td>
        </tr>
        <tr>
            <th>Nama Asmen</th>
            <td>{{ $form->Asmen->nama ?? '-' }}</td>
        </tr>
        <tr>
            <th>NIK Asmen</th>
            <td>{{ $form->Asmen->nik ?? '-' }}</td>
        </tr>
        <tr>
            <th>Jabatan Asmen</th>
            <td>{{ $form->Asmen->jabatan ?? '-' }}</td>
        </tr>
    </table>

    <!-- Detail Kejadian -->
    <div class="section-title">Detail Kejadian</div>
    <table>
        <thead>
            <tr>
                <th>Pukul</th>
                <th>Gardu</th>
                <th>Nomor Resi Awal</th>
                <th>Nomor Resi Akhir</th>
                <th>Gerbang</th>
                <th>Jumlah Kendaraan</th>
                <th>Golongan Kendaraan</th>
                <th>Instansi</th>
                <th>Penanggung Jawab</th>
                <th>Surat Izin Lintas</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($detailLolos as $detail)
                <tr>
                    <td>{{ $detail->pukul }}</td>
                    <td>{{ $detail->Gardu->gardu ?? '-' }}</td>
                    <td>{{ $detail->nomor_resi_awal ?? '-' }}</td>
                    <td>{{ $detail->nomor_resi_akhir ?? '-' }}</td>
                    <td>{{ $detail->Gerbang->name ?? '-' }}</td>
                    <td>{{ $detail->jumlah_kdr ?? '-' }}</td>
                    <td>{{ $detail->GolKdr->golongan ?? '-' }}</td>
                    <td>{{ $detail->Instansi->instansi ?? '-' }}</td>
                    <td>{{ $detail->penanggung_jawab ?? '-' }}</td>
                    <td>{{ $detail->surat_izin_lintas ? 'Ya' : 'Tidak' }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <!-- Total Biaya -->
    <div class="section-title">Total Biaya</div>
    <p>
        Total Biaya: Rp {{ number_format($totalBiaya ?? 0, 0, ',', '.') }}
    </p>

    <!-- Tanda Tangan -->
    <div class="signature-section">
        <div>
            <div class="signature-box"></div>
            <p class="signature-label">Petugas</p>
        </div>
        <div>
            <div class="signature-box"></div>
            <p class="signature-label">Pimpinan</p>
        </div>
    </div>

    <!-- Tombol Print -->
    <div class="btn-print">
        <button onclick="window.print()">Cetak</button>
    </div>
</div>

</body>
</html>
