<x-filament::widget>
    <x-filament::card>
        <!-- Bagian Kartu Statistik -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
            <div class="p-4 bg-gray-50 dark:bg-gray-800 border rounded-lg shadow">
                <h3 class="text-lg font-semibold text-gray-800 dark:text-gray-200">Total Akun</h3>
                <p class="mt-2 text-2xl font-bold text-blue-500">{{ $totalUsers }}</p>
                <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">Jumlah total pengguna di sistem.</p>
            </div>
            <div class="p-4 bg-gray-50 dark:bg-gray-800 border rounded-lg shadow">
                <h3 class="text-lg font-semibold text-gray-800 dark:text-gray-200">Total Customer Service</h3>
                <p class="mt-2 text-2xl font-bold text-blue-500">{{ $totalDataCs }}</p>
                <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">Jumlah customer service yang terdaftar.</p>
            </div>
            <div class="p-4 bg-gray-50 dark:bg-gray-800 border rounded-lg shadow">
                <h3 class="text-lg font-semibold text-gray-800 dark:text-gray-200">Total CS Supervisor</h3>
                <p class="mt-2 text-2xl font-bold text-blue-500">{{ $totalDataCss }}</p>
                <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">Jumlah supervisor customer service.</p>
            </div>
            <div class="p-4 bg-gray-50 dark:bg-gray-800 border rounded-lg shadow">
                <h3 class="text-lg font-semibold text-gray-800 dark:text-gray-200">Total Assistant Manager</h3>
                <p class="mt-2 text-2xl font-bold text-blue-500">{{ $totalAsmen }}</p>
                <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">Jumlah assistant manager yang terdaftar.</p>
            </div>
            <div class="p-4 bg-gray-50 dark:bg-gray-800 border rounded-lg shadow">
                <h3 class="text-lg font-semibold text-gray-800 dark:text-gray-200">Total Formulir</h3>
                <p class="mt-2 text-2xl font-bold text-blue-500">{{ $totalForms }}</p>
                <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">Jumlah total formulir yang telah dibuat.</p>
            </div>
            <div class="p-4 bg-gray-50 dark:bg-gray-800 border rounded-lg shadow">
                <h3 class="text-lg font-semibold text-gray-800 dark:text-gray-200">Formulir Baru (7 Hari Terakhir)</h3>
                <p class="mt-2 text-2xl font-bold text-green-500">{{ $recentForms }}</p>
                <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">Jumlah formulir baru dalam 7 hari terakhir.</p>
            </div>
        </div>
    </x-filament::card>
</x-filament::widget>
