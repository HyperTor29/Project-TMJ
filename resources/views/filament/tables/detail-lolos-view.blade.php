<div>
    @if (isset($record->detailLolos) && $record->detailLolos->isNotEmpty())
        @foreach ($record->detailLolos as $detail)
            <div class="p-2 border rounded mb-2">
                <p><strong>Pukul:</strong> {{ $detail->pukul }}</p>
                <p><strong>Gardu:</strong> {{ $detail->Gardu->gardu ?? 'N/A' }}</p>
                <p><strong>Nomor Resi:</strong> {{ $detail->nomor_resi_awal }} - {{ $detail->nomor_resi_akhir }}</p>
                <p><strong>Gerbang:</strong> {{ $detail->Gerbang->name ?? 'N/A' }}</p>
                <p><strong>Jumlah Kendaraan:</strong> {{ $detail->jumlah_kdr }}</p>
                <p><strong>Golongan:</strong> {{ $detail->GolKdr->golongan ?? 'N/A' }}</p>
                <p><strong>Nomor Kendaraan:</strong> {{ $detail->nomor_kendaraan }}</p>
            </div>
        @endforeach
    @else
        <p class="text-gray-500">Tidak ada detail lolos.</p>
    @endif
</div>
