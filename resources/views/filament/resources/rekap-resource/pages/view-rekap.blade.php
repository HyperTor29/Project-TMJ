<x-filament::page>
    <div class="space-y-6 dark:bg-gray-900 dark:text-white">
        <!-- Header dengan Tombol Kembali -->
        <div class="flex flex-col sm:flex-row justify-between items-center space-y-4 sm:space-y-0">
            <h2 class="text-2xl font-bold">Detail Rekapan</h2>
            <a href="{{ url()->previous() }}"
               class="flex items-center space-x-2 px-4 py-2 bg-gray-800 text-white text-sm font-medium rounded-lg shadow-md hover:bg-gray-300 transition duration-300">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 19.5L8.25 12l7.5-7.5" />
                </svg>
                <span>Kembali</span>
            </a>
        </div>

        <!-- Informasi Utama -->
        <div class="bg-white dark:bg-gray-800 shadow rounded-lg p-6">
            <h3 class="text-xl font-semibold mb-4">Informasi Petugas</h3>
            <dl class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
                <div class="bg-gray-50 dark:bg-gray-700 p-3 rounded">
                    <dt class="font-medium text-gray-600 dark:text-gray-400">Tanggal</dt>
                    <dd class="text-gray-800 dark:text-gray-200">{{ $record->tanggal }}</dd>
                </div>
                <div class="bg-gray-50 dark:bg-gray-700 p-3 rounded">
                    <dt class="font-medium text-gray-600 dark:text-gray-400">Shift</dt>
                    <dd class="text-gray-800 dark:text-gray-200">{{ $record->Shifts->shift ?? '-' }}</dd>
                </div>
                <div class="bg-gray-50 dark:bg-gray-700 p-3 rounded">
                    <dt class="font-medium text-gray-600 dark:text-gray-400">Nama CS</dt>
                    <dd class="text-gray-800 dark:text-gray-200">{{ $record->DataCs->nama ?? '-' }}</dd>
                </div>
                <div class="bg-gray-50 dark:bg-gray-700 p-3 rounded">
                    <dt class="font-medium text-gray-600 dark:text-gray-400">NIK CS</dt>
                    <dd class="text-gray-800 dark:text-gray-200">{{ $record->DataCs->nik ?? '-' }}</dd>
                </div>
                <div class="bg-gray-50 dark:bg-gray-700 p-3 rounded">
                    <dt class="font-medium text-gray-600 dark:text-gray-400">Jabatan CS</dt>
                    <dd class="text-gray-800 dark:text-gray-200">{{ $record->DataCs->jabatan ?? '-' }}</dd>
                </div>
                <div class="bg-gray-50 dark:bg-gray-700 p-3 rounded">
                    <dt class="font-medium text-gray-600 dark:text-gray-400">Nama CSS</dt>
                    <dd class="text-gray-800 dark:text-gray-200">{{ $record->DataCss->nama ?? '-' }}</dd>
                </div>
                <div class="bg-gray-50 dark:bg-gray-700 p-3 rounded">
                    <dt class="font-medium text-gray-600 dark:text-gray-400">NIK CSS</dt>
                    <dd class="text-gray-800 dark:text-gray-200">{{ $record->DataCss->nik ?? '-' }}</dd>
                </div>
                <div class="bg-gray-50 dark:bg-gray-700 p-3 rounded">
                    <dt class="font-medium text-gray-600 dark:text-gray-400">Jabatan CSS</dt>
                    <dd class="text-gray-800 dark:text-gray-200">{{ $record->DataCss->jabatan ?? '-' }}</dd>
                </div>
                <div class="bg-gray-50 dark:bg-gray-700 p-3 rounded">
                    <dt class="font-medium text-gray-600 dark:text-gray-400">Nama Asmen</dt>
                    <dd class="text-gray-800 dark:text-gray-200">{{ $record->Asmen->nama ?? '-' }}</dd>
                </div>
                <div class="bg-gray-50 dark:bg-gray-700 p-3 rounded">
                    <dt class="font-medium text-gray-600 dark:text-gray-400">NIK Asmen</dt>
                    <dd class="text-gray-800 dark:text-gray-200">{{ $record->Asmen->nik ?? '-' }}</dd>
                </div>
                <div class="bg-gray-50 dark:bg-gray-700 p-3 rounded">
                    <dt class="font-medium text-gray-600 dark:text-gray-400">Jabatan Asmen</dt>
                    <dd class="text-gray-800 dark:text-gray-200">{{ $record->Asmen->jabatan ?? '-' }}</dd>
                </div>
            </dl>
        </div>

        <!-- Detail Lolos -->
        <div class="bg-white dark:bg-gray-800 shadow rounded-lg p-6" x-data="{ open: false, imageUrl: '' }">
            <h3 class="text-xl font-semibold mb-4">Detail Kejadian</h3>
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-600">
                    <thead class="bg-gray-100 dark:bg-gray-700">
                        <tr>
                            <th class="px-4 py-2 text-left text-sm font-medium text-gray-600 dark:text-gray-400">Pukul</th>
                            <th class="px-4 py-2 text-left text-sm font-medium text-gray-600 dark:text-gray-400">Gardu</th>
                            <th class="px-4 py-2 text-left text-sm font-medium text-gray-600 dark:text-gray-400">Nomor Resi Awal</th>
                            <th class="px-4 py-2 text-left text-sm font-medium text-gray-600 dark:text-gray-400">Nomor Resi Akhir</th>
                            <th class="px-4 py-2 text-left text-sm font-medium text-gray-600 dark:text-gray-400">Gerbang</th>
                            <th class="px-4 py-2 text-left text-sm font-medium text-gray-600 dark:text-gray-400">Jumlah Kendaraan</th>
                            <th class="px-4 py-2 text-left text-sm font-medium text-gray-600 dark:text-gray-400">Golongan Kendaraan</th>
                            <th class="px-4 py-2 text-left text-sm font-medium text-gray-600 dark:text-gray-400">Nomor Kendaraan</th>
                            <th class="px-4 py-2 text-left text-sm font-medium text-gray-600 dark:text-gray-400">Instansi</th>
                            <th class="px-4 py-2 text-left text-sm font-medium text-gray-600 dark:text-gray-400">Penanggung Jawab</th>
                            <th class="px-4 py-2 text-left text-sm font-medium text-gray-600 dark:text-gray-400">Surat Izin Lintas</th>
                            <th class="px-4 py-2 text-left text-sm font-medium text-gray-600 dark:text-gray-400">Foto Surat</th>
                            <th class="px-4 py-2 text-left text-sm font-medium text-gray-600 dark:text-gray-400">Foto Kendaraan</th>
                            @php
                                $userRole = Auth::user()->role->name;
                            @endphp

                            @if(in_array($userRole, ['Admin', 'Verificator', 'Validator']))
                            <th class="px-4 py-2 text-left text-sm font-medium text-gray-600 dark:text-gray-400">Aksi</th>
                            @endif
                        </tr>
                    </thead>
                    <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-600">
                        @foreach ($record->DetailLolos as $detail)
                            <tr>
                                <td class="px-4 py-2 text-sm text-gray-800 dark:text-gray-200">{{ $detail->pukul }}</td>
                                <td class="px-4 py-2 text-sm text-gray-800 dark:text-gray-200">{{ $detail->Gardu->gardu ?? '-' }}</td>
                                <td class="px-4 py-2 text-sm text-gray-800 dark:text-gray-200">{{ $detail->nomor_resi_awal ?? '-' }}</td>
                                <td class="px-4 py-2 text-sm text-gray-800 dark:text-gray-200">{{ $detail->nomor_resi_akhir ?? '-' }}</td>
                                <td class="px-4 py-2 text-sm text-gray-800 dark:text-gray-200">{{ $detail->Gerbang->name ?? '-' }}</td>
                                <td class="px-4 py-2 text-sm text-gray-800 dark:text-gray-200">{{ $detail->jumlah_kdr ?? '-' }}</td>
                                <td class="px-4 py-2 text-sm text-gray-800 dark:text-gray-200">{{ $detail->GolKdr->golongan ?? '-' }}</td>
                                <td class="px-4 py-2 text-sm text-gray-800 dark:text-gray-200">{{ $detail->nomor_kendaraan ?? '-' }}</td>
                                <td class="px-4 py-2 text-sm text-gray-800 dark:text-gray-200">{{ $detail->Instansi->instansi ?? '-' }}</td>
                                <td class="px-4 py-2 text-sm text-gray-800 dark:text-gray-200">{{ $detail->penanggung_jawab ?? '-' }}</td>
                                <td class="px-4 py-2 text-sm text-gray-800 dark:text-gray-200">
                                    {{ $detail->surat_izin_lintas ? 'Ya' : 'Tidak' }}
                                </td>
                                <!-- Foto Surat -->
                                <td class="px-4 py-2 text-sm text-gray-800 dark:text-gray-200">
                                    @if ($detail->surats->isNotEmpty())
                                        <div class="flex flex-wrap gap-2">
                                            @foreach ($detail->surats as $surat)
                                                <img src="{{ asset('storage/' . $surat->surat) }}" alt="Foto Surat"
                                                    class="w-16 h-16 object-cover rounded-lg cursor-pointer hover:opacity-75 transition-opacity duration-300"
                                                    @click="open = true; imageUrl = '{{ asset('storage/' . $surat->surat) }}'">
                                            @endforeach
                                        </div>
                                    @else
                                        <span>-</span>
                                    @endif
                                </td>
                                <!-- Foto Kendaraan -->
                                <td class="px-4 py-2 text-sm text-gray-800 dark:text-gray-200">
                                    @if ($detail->fotos->isNotEmpty())
                                        <div class="flex flex-wrap gap-2">
                                            @foreach ($detail->fotos as $foto)
                                                <img src="{{ asset('storage/' . $foto->foto) }}" alt="Foto Kendaraan"
                                                    class="w-16 h-16 object-cover rounded-lg cursor-pointer hover:opacity-75 transition-opacity duration-300"
                                                    @click="open = true; imageUrl = '{{ asset('storage/' . $foto->foto) }}'">
                                            @endforeach
                                        </div>
                                    @else
                                        <span>-</span>
                                    @endif
                                </td>
                                <td class="px-4 py-2 text-sm text-gray-800 dark:text-gray-200">
                                    <div class="flex space-x-2">
                                        @php
                                            $userRole = Auth::user()->role->name;
                                        @endphp

                                        @if(in_array($userRole, ['Admin', 'Verificator', 'Validator']))
                                            <!-- Tombol Accept -->
                                            <form action="{{ route('rekapan.accept-single', ['id' => $record->id, 'detailId' => $detail->id]) }}" method="POST">
                                                @csrf
                                                <button type="submit" class="px-4 py-2 bg-green-600 text-white text-sm font-medium rounded-md shadow hover:bg-green-700 transition-all duration-300 focus:outline-none focus:ring-2 focus:ring-green-300">
                                                    Accept
                                                </button>
                                            </form>

                                            <!-- Tombol Reject -->
                                            <form action="{{ route('rekapan.reject-single', ['id' => $record->id, 'detailId' => $detail->id]) }}" method="POST">
                                                @csrf
                                                <button type="submit" class="px-4 py-2 bg-red-600 text-white text-sm font-medium rounded-md shadow hover:bg-red-700 transition-all duration-300 focus:outline-none focus:ring-2 focus:ring-red-300">
                                                    Reject
                                                </button>
                                            </form>
                                        @endif
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <!-- Menampilkan Jumlah Kendaraan -->
            <div class="bg-white dark:bg-gray-800 shadow rounded-lg p-6 mt-6">
                <h3 class="text-xl font-semibold mb-4">Jumlah Kendaraan</h3>
                <div class="text-gray-800 dark:text-gray-200 text-lg">
                    Total Jumlah Kendaraan: <strong>{{ $record->DetailLolos->sum('jumlah_kdr') }}</strong>
                </div>
            </div>

            <!-- Menampilkan Perhitungan Total Biaya -->
            <div class="bg-white dark:bg-gray-800 shadow rounded-lg p-6 mt-6">
                <h3 class="text-xl font-semibold mb-4">Perhitungan Total Biaya</h3>
                <div class="text-gray-800 dark:text-gray-200">
                    @php
                        $totalBiaya = 0;
                    @endphp
                    <div class="grid gap-4 sm:grid-cols-2 lg:grid-cols-3">
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

                            <div class="p-4 bg-gray-100 dark:bg-gray-700 rounded-lg shadow-sm">
                                <div class="flex justify-between items-center">
                                    <div>
                                        <strong class="text-lg">{{ $detail_lolos->GolKdr->golongan }}</strong> -
                                        <strong class="text-lg">{{ $detail_lolos->Gerbang->name }}</strong>
                                    </div>
                                    <div class="text-sm text-gray-600 dark:text-gray-400">
                                        Jumlah: <strong>{{ $detail_lolos->jumlah_kdr }}</strong>
                                    </div>
                                </div>
                                <div class="mt-2">
                                    <span class="text-sm text-gray-500">Biaya: </span>
                                    <span class="font-semibold">Rp {{ number_format($biaya, 0, ',', '.') }}</span>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <div class="mt-6 p-4 bg-gray-200 dark:bg-gray-600 rounded-lg text-center">
                        <strong class="text-xl">Total Biaya: </strong>
                        <span class="font-semibold text-2xl">Rp {{ number_format($totalBiaya, 0, ',', '.') }}</span>
                    </div>
                </div>
            </div>

            <!-- Modal -->
            <div x-show="open"
                x-transition
                class="fixed inset-0 bg-gray-900 bg-opacity-75 flex items-center justify-center z-50 p-4">
                <div class="relative bg-white dark:bg-gray-800 rounded-lg overflow-hidden shadow-lg max-w-full max-h-full">
                    <!-- Tombol Silang -->
                    <button class="absolute top-2 right-2 text-gray-700 bg-gray-100 dark:bg-gray-700 rounded-full w-8 h-8 flex items-center justify-center hover:bg-gray-200 dark:hover:bg-gray-600 transition-colors duration-300"
                            @click="open = false">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-5 h-5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                    <!-- Gambar Foto -->
                    <img :src="imageUrl" alt="Foto Detail" class="w-full h-auto max-h-screen object-contain">
                </div>
            </div>
        </div>
    </div>

    <!-- Tombol Accept, Reject, dan Print -->
    <div class="mt-6 pb-6">
        <div class="flex flex-wrap justify-end gap-2">
            @php
                $userRole = Auth::user()->role->name;
            @endphp

            @if(in_array($userRole, ['Admin', 'Verificator', 'Validator']))
                <!-- Tombol Print -->
                <a href="{{ route('rekapan.print', ['id' => $record->id]) }}"
                    target="_blank"
                    class="px-4 py-2 bg-blue-600 text-white text-sm font-medium rounded-md shadow hover:bg-blue-700 transition-all duration-300 focus:outline-none focus:ring-2 focus:ring-blue-300">
                    Print
                </a>

                <!-- Tombol Accept -->
                <form action="{{ route('rekapan.accept', $record->id) }}" method="POST" onsubmit="return confirm('Apakah anda yakin ingin menerima semua?');">
                    @csrf
                    @foreach ($record->DetailLolos as $detail)
                        <input type="hidden" name="detailLolosIds[]" value="{{ $detail->id }}">
                    @endforeach
                    <button type="submit" class="px-4 py-2 bg-green-600 text-white text-sm font-medium rounded-md shadow hover:bg-green-700 transition-all duration-300 focus:outline-none focus:ring-2 focus:ring-green-300">
                        Accept All
                    </button>
                </form>

                <!-- Tombol Reject -->
                <form action="{{ route('rekapan.reject', $record->id) }}" method="POST" onsubmit="return confirm('Apakah anda yakin ingin menolak semua?');">
                    @csrf
                    @foreach ($record->DetailLolos as $detail)
                        <input type="hidden" name="detailLolosIds[]" value="{{ $detail->id }}">
                    @endforeach
                    <button type="submit" class="px-4 py-2 bg-red-600 text-white text-sm font-medium rounded-md shadow hover:bg-red-700 transition-all duration-300 focus:outline-none focus:ring-2 focus:ring-red-300">
                        Reject All
                    </button>
                </form>
            @endif
        </div>
    </div>
</x-filament::page>

