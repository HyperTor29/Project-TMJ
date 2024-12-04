<x-filament::page>
    <div class="space-y-6">
        <!-- Header dengan Tombol Kembali -->
        <div class="flex justify-between items-center">
            <h2 class="text-2xl font-bold border-b pb-2">Detail Rekapan</h2>
            <a href="{{ route('rekaps.index') }}"
               class="flex items-center space-x-2 px-4 py-2 bg-gray-800 text-black text-sm font-medium rounded-lg shadow-md hover:bg-gray-700">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 19.5L8.25 12l7.5-7.5" />
                </svg>
                <span>Kembali</span>
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
                    <dt class="font-medium text-gray-600">Shift</dt>
                    <dd class="text-gray-800">{{ $record->Shifts->shift ?? '-' }}</dd>
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
        <div class="bg-white shadow rounded-lg p-6" x-data="{ open: false, imageUrl: '' }">
            <h3 class="text-xl font-semibold mb-4">Detail Kejadian</h3>
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-100">
                        <tr>
                            <th class="px-4 py-2 text-left text-sm font-medium text-gray-600">Pukul</th>
                            <th class="px-4 py-2 text-left text-sm font-medium text-gray-600">Gardu</th>
                            <th class="px-4 py-2 text-left text-sm font-medium text-gray-600">Nomor Resi Awal</th>
                            <th class="px-4 py-2 text-left text-sm font-medium text-gray-600">Nomor Resi Akhir</th>
                            <th class="px-4 py-2 text-left text-sm font-medium text-gray-600">Gerbang</th>
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
                                <td class="px-4 py-2 text-sm text-gray-800">{{ $detail->Gerbang->name ?? '-' }}</td>
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
                                                class="w-16 h-16 object-cover rounded-lg cursor-pointer"
                                                @click="open = true; imageUrl = '{{ asset('storage/' . $surat->surat) }}'">
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
                                                class="w-16 h-16 object-cover rounded-lg cursor-pointer"
                                                @click="open = true; imageUrl = '{{ asset('storage/' . $foto->foto) }}'">
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

            <!-- Menampilkan Jumlah Kendaraan -->
            <div class="bg-white shadow rounded-lg p-6 mt-6">
                <h3 class="text-xl font-semibold mb-4">Jumlah Kendaraan</h3>
                <div class="text-gray-800">
                    Total Jumlah Kendaraan: <strong>{{ $record->DetailLolos->sum('jumlah_kdr') }}</strong>
                </div>
            </div>

            <!-- Menampilkan Perhitungan Total Biaya -->
            <div class="bg-white shadow rounded-lg p-6 mt-6">
                <h3 class="text-xl font-semibold mb-4">Perhitungan Total Biaya</h3>
                <div class="text-gray-800">
                    @php
                        $totalBiaya = 0;
                    @endphp
                    <div class="space-y-4">
                        @foreach ($record->DetailLolos as $detail_lolos)
                            @php
                                $tarif = \App\Models\Tarif::whereHas('GolKdr', function($query) use ($detail_lolos) {
                                    $query->where('golongan', $detail_lolos->GolKdr->golongan);
                                })
                                ->whereHas('Gerbang', function($query) use ($detail_lolos) {
                                    $query->where('name', $detail_lolos->Gerbang->name);
                                })
                                ->first();

                                $biaya = $tarif ? $tarif->tarif * $detail_lolos->jumlah_kdr : 0;
                                $totalBiaya += $biaya;
                            @endphp

                            <div class="p-4 bg-gray-100 rounded-lg shadow-sm">
                                <div class="flex justify-between items-center">
                                    <div>
                                        <strong class="text-lg">{{ $detail_lolos->GolKdr->golongan }}</strong> -
                                        <strong class="text-lg">{{ $detail_lolos->Gerbang->name }}</strong>
                                    </div>
                                    <div class="text-sm text-gray-600">
                                        Jumlah Kendaraan: <strong>{{ $detail_lolos->jumlah_kdr }}</strong>
                                    </div>
                                </div>
                                <div class="mt-2">
                                    <span class="text-sm text-gray-500">Biaya: </span>
                                    <span class="font-semibold">Rp {{ number_format($biaya, 0, ',', '.') }}</span>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <div class="mt-6 p-4 bg-gray-200 rounded-lg">
                        <strong>Total Biaya: </strong>
                        <span class="font-semibold text-xl">Rp {{ number_format($totalBiaya, 0, ',', '.') }}</span>
                    </div>
                </div>
            </div>

            <!-- Modal -->
            <div x-show="open"
                x-transition
                class="fixed inset-0 bg-gray-900 bg-opacity-75 flex items-center justify-center z-50 p-4">
                <div class="relative bg-white rounded-lg overflow-hidden shadow-lg max-w-full max-h-full">
                    <!-- Tombol Silang -->
                    <button class="absolute top-2 right-2 text-gray-700 bg-gray-100 rounded-full w-8 h-8 flex items-center justify-center hover:bg-gray-200"
                            @click="open = false">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-5 h-5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                    <!-- Gambar Foto -->
                    <img :src="imageUrl" alt="Foto Detail" class="w-full h-auto max-h-screen">
                </div>
            </div>
        </div>
    </div>

    <!-- Tombol Accept, Reject, dan Print -->
    <div class="flex justify-end space-x-4 mt-6">
        @php
            $userRole = Auth::user()->role->name;
        @endphp

        @if(in_array($userRole, ['Admin', 'Verificator', 'Validator']))
            <!-- Tombol Print -->
            <a href="{{ route('rekapan.print', ['id' => $record->id]) }}"
                target="_blank"
                class="px-6 py-3 bg-blue-600 text-black text-lg font-semibold rounded-md shadow-lg hover:bg-blue-700 transition-all duration-300 focus:outline-none focus:ring-4 focus:ring-blue-300 border-2 border-black">
                Cetak
            </a>

            <!-- Tombol Accept -->
            <form action="{{ route('rekapan.accept', ['formId' => $record->id]) }}" method="POST">
                @csrf
                @foreach ($record->DetailLolos as $detail)
                    <input type="hidden" name="detailLolosIds[]" value="{{ $detail->id }}">
                @endforeach
                <button type="submit" class="px-6 py-3 bg-blue-600 text-black text-lg font-semibold rounded-md shadow-lg hover:bg-blue-700 transition-all duration-300 focus:outline-none focus:ring-4 focus:ring-blue-300 border-2 border-black">
                    Accept
                </button>
            </form>

            <!-- Tombol Reject -->
            <form action="{{ route('rekapan.reject', ['formId' => $record->id]) }}" method="POST">
                @csrf
                @foreach ($record->DetailLolos as $detail)
                    <input type="hidden" name="detailLolosIds[]" value="{{ $detail->id }}">
                @endforeach
                <button type="submit" class="px-6 py-3 bg-blue-600 text-black text-lg font-semibold rounded-md shadow-lg hover:bg-blue-700 transition-all duration-300 focus:outline-none focus:ring-4 focus:ring-blue-300 border-2 border-black">
                    Reject
                </button>
            </form>
        @endif
    </div>
</x-filament::page>
