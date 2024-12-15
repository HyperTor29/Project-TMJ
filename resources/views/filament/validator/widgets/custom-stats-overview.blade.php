<x-filament::widget>
    <x-filament::card>
        <!-- Kartu Statistik -->
        <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
            <div class="p-4 bg-gray-50 dark:bg-gray-800 border rounded-lg shadow">
                <h3 class="text-lg font-semibold text-gray-800 dark:text-gray-200">Total Data Divalidasi</h3>
                <p class="mt-2 text-2xl font-bold text-blue-500">{{ $totalForms }}</p>
                <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">Jumlah total data yang telah divalidasi.</p>
            </div>
            <div class="p-4 bg-gray-50 dark:bg-gray-800 border rounded-lg shadow">
                <h3 class="text-lg font-semibold text-gray-800 dark:text-gray-200">Data Baru Divalidasi (7 Hari Terakhir)</h3>
                <p class="mt-2 text-2xl font-bold text-green-500">{{ $recentForms }}</p>
                <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">Data baru yang divalidasi dalam 7 hari terakhir.</p>
            </div>
        </div>

        <!-- Diagram Statistik -->
        <div class="bg-white dark:bg-gray-800 shadow rounded-lg p-6 mt-6">
            <h3 class="text-xl font-semibold mb-4">Diagram Statistik Data Diverifikasi</h3>
            <canvas id="verificationChart" class="w-full h-64"></canvas>
        </div>
    </x-filament::card>
</x-filament::widget>
