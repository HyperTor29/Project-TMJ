<?php

namespace App\Filament\Viewer\Widgets;

use Filament\Widgets\ChartWidget;
use App\Models\DetailLolos;

class InstansiChartWidget extends ChartWidget
{
    protected static ?string $heading = 'Jumlah Kendaraan tiap Instansi per Tahun';

    protected function getData(): array
    {
        $instansiData = DetailLolos::with('Instansi')
            ->get()
            ->groupBy(fn($detail) => ($detail->Instansi->instansi ?? 'Unknown') . ' - ' . $detail->created_at->year);

        $datasets = [];
        $instansiNames = $instansiData->keys()->map(fn($key) => explode(' - ', $key)[0])->unique();
        $colors = $this->generateConsistentColors($instansiNames);

        foreach ($instansiData as $key => $details) {
            $instansiName = explode(' - ', $key)[0];
            $monthlyData = array_fill(0, 12, 0);

            foreach ($details as $detail) {
                $monthIndex = $detail->created_at->month - 1;
                $monthlyData[$monthIndex]++;
            }

            $datasets[] = [
                'label' => $key,
                'data' => $monthlyData,
                'backgroundColor' => $colors[$instansiName] ?? 'rgba(0, 0, 0, 0.7)',
                'borderWidth' => 1,
            ];
        }

        return [
            'datasets' => $datasets,
            'labels' => $this->getMonthLabels(),
        ];
    }

    protected function getType(): string
    {
        return 'bar';
    }

    private function getMonthLabels(): array
    {
        return ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'];
    }

    private function generateConsistentColors($instansiNames): array
    {
        $baseColors = [
            'Admin' => 'rgba(255, 99, 132, 0.7)',
            'User' => 'rgba(54, 162, 235, 0.7)',
            'Verificator' => 'rgba(255, 206, 86, 0.7)',
            'Validator' => 'rgba(75, 192, 192, 0.7)',
            'Viewer' => 'rgba(153, 102, 255, 0.7)',
        ];

        $colors = [];
        foreach ($instansiNames as $name) {
            $colors[$name] = $baseColors[$name] ?? sprintf('rgba(%d, %d, %d, 0.7)', crc32($name) % 256, crc32($name . 'x') % 256, crc32($name . 'y') % 256);
        }

        return $colors;
    }
}
