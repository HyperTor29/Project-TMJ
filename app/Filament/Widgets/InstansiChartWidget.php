<?php

namespace App\Filament\Widgets;

use Filament\Widgets\ChartWidget;
use App\Models\DetailLolos;

class InstansiChartWidget extends ChartWidget
{
    protected static ?string $heading = 'Jumlah Kendaraan per Instansi per Tahun';

    protected function getData(): array
    {
        $instansiData = DetailLolos::with('Instansi')
            ->get()
            ->groupBy(fn($detail) => ($detail->Instansi->instansi ?? 'Unknown') . ' - ' . $detail->created_at->year)
            ->map(function ($details, $key) {
                $monthlyData = array_fill(0, 12, 0);
                foreach ($details as $detail) {
                    $monthIndex = $detail->created_at->month - 1;
                    $monthlyData[$monthIndex]++;
                }
                return [
                    'label' => $key,
                    'data' => $monthlyData,
                ];
            });

        $datasets = [];
        foreach ($instansiData as $data) {
            $datasets[] = [
                'label' => $data['label'],
                'data' => $data['data'],
                'borderWidth' => 2,
            ];
        }

        return [
            'datasets' => $datasets,
            'labels' => $this->getMonthLabels(),
        ];
    }

    protected function getType(): string
    {
        return 'line';
    }

    private function getMonthLabels(): array
    {
        return ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'];
    }
}
