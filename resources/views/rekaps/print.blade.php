<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Rekapan</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }
        .container {
            width: 100%;
            padding: 20px;
        }
        h2 {
            text-align: center;
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
        }
        th {
            background-color: #f2f2f2;
        }
        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        .btn-print {
            margin-top: 20px;
            text-align: right;
        }
        @media print {
            .btn-print {
                display: none;
            }
        }
    </style>
</head>
<body>

<div class="container">
    <div class="header">
        <h2>Laporan Detail Rekapan</h2>
        <div>
            <button onclick="window.print()" class="btn-print">
                Cetak
            </button>
        </div>
    </div>

    <!-- Informasi Petugas -->
    <h3>Informasi Petugas</h3>
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
    <h3>Detail Kejadian</h3>
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
    <h3>Total Biaya</h3>
    <p>
        Total Biaya: Rp {{ number_format($totalBiaya ?? 0, 0, ',', '.') }}
    </p>

</div>

</body>
</html>
