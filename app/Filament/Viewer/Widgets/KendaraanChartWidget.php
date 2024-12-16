<?php

namespace App\Filament\Viewer\Widgets;

use Filament\Widgets\ChartWidget;
use App\Models\DetailLolos;

class KendaraanChartWidget extends ChartWidget
{
    protected static ?string $heading = 'Jumlah Kendaraan per Bulan';

    protected function getData(): array
    {
        $kendaraanData = DetailLolos::selectRaw('MONTH(created_at) as month, SUM(jumlah_kdr) as total')
            ->groupBy('month')
            ->orderBy('month')
            ->pluck('total', 'month')
            ->toArray();

        return [
            'datasets' => [
                [
                    'label' => 'Jumlah Kendaraan',
                    'data' => $this->fillMissingMonths($kendaraanData),
                    'borderWidth' => 2,
                ],
            ],
            'labels' => $this->getMonthLabels(),
        ];
    }

    protected function getType(): string
    {
        return 'bar';
    }

    private function fillMissingMonths(array $data): array
    {
        return array_map(fn($i) => $data[$i] ?? 0, range(1, 12));
    }

    private function getMonthLabels(): array
    {
        return ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'];
    }
}
