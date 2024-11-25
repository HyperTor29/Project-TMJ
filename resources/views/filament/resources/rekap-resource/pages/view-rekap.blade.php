<x-filament::page>
    <div class="space-y-6">
        <!-- Header dengan Tombol Kembali -->
        <div class="flex justify-between items-center">
            <h2 class="text-2xl font-bold border-b pb-2">Detail Rekapan</h2>
            <a href="{{ static::getResource()::getUrl('index') }}"
               class="px-4 py-2 bg-gray-800 text-white text-sm font-medium rounded-lg hover:bg-gray-700">
                Kembali
            </a>
        </div>

        <!-- Informasi Utama -->
        <div class="bg-white shadow rounded-lg p-6">
            <h3 class="text-xl font-semibold mb-4">Informasi Petugas</h3>
            <dl class="grid grid-cols-2 gap-4">
                <div>
                    <dt class="font-medium text-gray-600">Tanggal</dt>
                    <dd class="text-gray-800">{{ $record->tanggal }}</dd>
                </div>
                <div>
                    <dt class="font-medium text-gray-600">Nama CS</dt>
                    <dd class="text-gray-800">{{ $record->DataCs->nama ?? '-' }}</dd>
                </div>
                <div>
                    <dt class="font-medium text-gray-600">NIK CS</dt>
                    <dd class="text-gray-800">{{ $record->DataCs->nik ?? '-' }}</dd>
                </div>
                <div>
                    <dt class="font-medium text-gray-600">Jabatan CS</dt>
                    <dd class="text-gray-800">{{ $record->DataCs->jabatan ?? '-' }}</dd>
                </div>
                <div>
                    <dt class="font-medium text-gray-600">Nama CSS</dt>
                    <dd class="text-gray-800">{{ $record->DataCss->nama ?? '-' }}</dd>
                </div>
                <div>
                    <dt class="font-medium text-gray-600">NIK CSS</dt>
                    <dd class="text-gray-800">{{ $record->DataCss->nik ?? '-' }}</dd>
                </div>
                <div>
                    <dt class="font-medium text-gray-600">Jabatan CSS</dt>
                    <dd class="text-gray-800">{{ $record->DataCss->jabatan ?? '-' }}</dd>
                </div>
                <div>
                    <dt class="font-medium text-gray-600">Nama Asmen</dt>
                    <dd class="text-gray-800">{{ $record->Asmen->nama ?? '-' }}</dd>
                </div>
                <div>
                    <dt class="font-medium text-gray-600">NIK Asmen</dt>
                    <dd class="text-gray-800">{{ $record->Asmen->nik ?? '-' }}</dd>
                </div>
                <div>
                    <dt class="font-medium text-gray-600">Jabatan Asmen</dt>
                    <dd class="text-gray-800">{{ $record->Asmen->jabatan ?? '-' }}</dd>
                </div>
            </dl>
        </div>

        <!-- Detail Lolos -->
        <div class="bg-white shadow rounded-lg p-6">
            <h3 class="text-xl font-semibold mb-4">Detail Kejadian</h3>
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-100">
                        <tr>
                            <th class="px-4 py-2 text-left text-sm font-medium text-gray-600">Pukul</th>
                            <th class="px-4 py-2 text-left text-sm font-medium text-gray-600">Gardu</th>
                            <th class="px-4 py-2 text-left text-sm font-medium text-gray-600">Nomor Resi Awal</th>
                            <th class="px-4 py-2 text-left text-sm font-medium text-gray-600">Nomor Resi Akhir</th>
                            <th class="px-4 py-2 text-left text-sm font-medium text-gray-600">Jumlah Kendaraan</th>
                            <th class="px-4 py-2 text-left text-sm font-medium text-gray-600">Golongan Kendaraan</th>
                            <th class="px-4 py-2 text-left text-sm font-medium text-gray-600">Instansi</th>
                            <th class="px-4 py-2 text-left text-sm font-medium text-gray-600">Penanggung Jawab</th>
                            <th class="px-4 py-2 text-left text-sm font-medium text-gray-600">Surat Izin Lintas</th>
                            <th class="px-4 py-2 text-left text-sm font-medium text-gray-600">Foto Surat</th>
                            <th class="px-4 py-2 text-left text-sm font-medium text-gray-600">Foto Kendaraan</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @foreach ($record->DetailLolos as $detail)
                            <tr>
                                <td class="px-4 py-2 text-sm text-gray-800">{{ $detail->pukul }}</td>
                                <td class="px-4 py-2 text-sm text-gray-800">{{ $detail->Gardu->gardu ?? '-' }}</td>
                                <td class="px-4 py-2 text-sm text-gray-800">{{ $detail->nomor_resi_awal ?? '-' }}</td>
                                <td class="px-4 py-2 text-sm text-gray-800">{{ $detail->nomor_resi_akhir ?? '-' }}</td>
                                <td class="px-4 py-2 text-sm text-gray-800">{{ $detail->jumlah_kdr ?? '-' }}</td>
                                <td class="px-4 py-2 text-sm text-gray-800">{{ $detail->GolKdr->golongan ?? '-' }}</td>
                                <td class="px-4 py-2 text-sm text-gray-800">{{ $detail->Instansi->instansi ?? '-' }}</td>
                                <td class="px-4 py-2 text-sm text-gray-800">{{ $detail->penanggung_jawab ?? '-' }}</td>
                                <td class="px-4 py-2 text-sm text-gray-800">
                                    {{ $detail->surat_izin_lintas ? 'Ya' : 'Tidak' }}
                                </td>
                                <!-- Foto Surat -->
                                <td class="px-4 py-2 text-sm text-gray-800">
                                    @if ($detail->surats->isNotEmpty())
                                        @foreach ($detail->surats as $surat)
                                            <img src="{{ asset('storage/' . $surat->surat) }}" alt="Foto Surat"
                                                class="w-16 h-16 object-cover rounded-lg mb-2">
                                        @endforeach
                                    @else
                                        <span>-</span>
                                    @endif
                                </td>
                                <!-- Foto Kendaraan -->
                                <td class="px-4 py-2 text-sm text-gray-800">
                                    @if ($detail->fotos->isNotEmpty())
                                        @foreach ($detail->fotos as $foto)
                                            <img src="{{ asset('storage/' . $foto->foto) }}" alt="Foto Kendaraan"
                                                class="w-16 h-16 object-cover rounded-lg mb-2">
                                        @endforeach
                                    @else
                                        <span>-</span>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-filament::page>
