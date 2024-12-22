<?php

namespace App\Filament\Widgets;

use Filament\Widgets\ChartWidget;
use App\Models\DetailLolos;

class KendaraanChartWidget extends ChartWidget
{
    protected static ?string $heading = 'Jumlah Total Kendaraan per Bulan';

    protected function getData(): array
    {
        $kendaraanData = DetailLolos::selectRaw('YEAR(created_at) as year, MONTH(created_at) as month, SUM(jumlah_kdr) as total')
            ->groupByRaw('YEAR(created_at), MONTH(created_at)')
            ->orderByRaw('YEAR(created_at), MONTH(created_at)')
            ->get()
            ->groupBy('year');

        $datasets = [];
        $labels = $this->getMonthLabels();
        foreach ($kendaraanData as $year => $dataPerYear) {
            $yearData = array_fill(0, 12, 0);
            foreach ($dataPerYear as $data) {
                $yearData[$data->month - 1] = $data->total;
            }
            $datasets[] = [
                'label' => "Jumlah Kendaraan - $year",
                'data' => $yearData,
                'borderWidth' => 2,
            ];
        }

        return [
            'datasets' => $datasets,
            'labels' => $labels,
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
}
