<div class="p-4 bg-white border rounded-lg shadow-md w-full">
    <table class="min-w-full divide-y divide-gray-200">
        <thead class="bg-gray-50">
            <tr>
                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                    Informasi Data
                </th>
                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                    Jumlah
                </th>
            </tr>
        </thead>
        <tbody class="bg-white divide-y divide-gray-200">
            <tr>
                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                    Total Akun
                </td>
                <td class="px-6 py-4 whitespace-nowrap text-sm text-blue-500">
                    {{ $totalUsers }}
                </td>
            </tr>
            <tr>
                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                    Total Customer Service
                </td>
                <td class="px-6 py-4 whitespace-nowrap text-sm text-blue-500">
                    {{ $totalDataCs }}
                </td>
            </tr>
            <tr>
                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                    Total Customer Service Supervisor
                </td>
                <td class="px-6 py-4 whitespace-nowrap text-sm text-blue-500">
                    {{ $totalDataCss }}
                </td>
            </tr>
            <tr>
                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                    Total Assistant Manager
                </td>
                <td class="px-6 py-4 whitespace-nowrap text-sm text-blue-500">
                    {{ $totalAsmen }}
                </td>
            </tr>
        </tbody>
    </table>
</div>

