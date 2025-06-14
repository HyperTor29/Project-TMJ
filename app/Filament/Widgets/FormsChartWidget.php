<?php

namespace App\Filament\Widgets;

use Filament\Widgets\ChartWidget;
use App\Models\Form;

class FormsChartWidget extends ChartWidget
{
    protected static ?string $heading = 'Jumlah Total Formulir per Bulan';

    protected function getData(): array
    {
        $selectedYear = $this->filter ?? now()->year;

        $query = Form::selectRaw('YEAR(created_at) as year, MONTH(created_at) as month, COUNT(*) as total')
            ->whereYear('created_at', $selectedYear)
            ->groupByRaw('YEAR(created_at), MONTH(created_at)')
            ->orderByRaw('YEAR(created_at), MONTH(created_at)');

        $formData = $query->get()
            ->groupBy('year');

        $datasets = [];
        $labels = $this->getMonthLabels();
        $colors = ['#60A5FA', '#34D399', '#FBBF24', '#F87171', '#A78BFA', '#FB923C', '#10B981'];

        foreach ($formData as $year => $dataPerYear) {
            $yearData = array_fill(0, 12, 0);
            foreach ($dataPerYear as $data) {
                $monthIndex = $data->month - 1;
                $yearData[$monthIndex] = $data->total; // Menggunakan data asli tanpa pembulatan
            }

            $datasets[] = [
                'label' => "Formulir Tahun $year",
                'data' => $yearData,
                'borderColor' => $colors[0],
                'backgroundColor' => $colors[0] . '33',
                'tension' => 0.4,
                'fill' => true,
                'borderWidth' => 2,
            ];
        }

        if (empty($datasets)) {
            $datasets[] = [
                'label' => "Formulir Tahun " . $selectedYear,
                'data' => array_fill(0, 12, 0),
                'borderColor' => $colors[0],
                'backgroundColor' => $colors[0] . '33',
                'tension' => 0.4,
                'fill' => true,
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
        return 'line';
    }

    protected function getFilters(): ?array
    {
        $years = Form::selectRaw('YEAR(created_at) as year')
            ->distinct()
            ->orderByDesc('year')
            ->pluck('year')
            ->toArray();

        if (empty($years)) {
            $years = [now()->year];
        }

        $formattedYears = [];
        foreach ($years as $year) {
            $formattedYears[(string)$year] = (string)$year;
        }

        return $formattedYears;
    }

    private function getMonthLabels(): array
    {
        return ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Ags', 'Sep', 'Okt', 'Nov', 'Des'];
    }
}
