<?php

namespace App\Filament\Viewer\Widgets;

use Filament\Widgets\ChartWidget;
use App\Models\Form;

class FormsChartWidget extends ChartWidget
{
    protected static ?string $heading = 'Jumlah Total Formulir per Bulan';

    protected function getData(): array
    {
        $formData = Form::selectRaw('YEAR(created_at) as year, MONTH(created_at) as month, COUNT(*) as total')
            ->groupByRaw('YEAR(created_at), MONTH(created_at)')
            ->orderByRaw('YEAR(created_at), MONTH(created_at)')
            ->get()
            ->groupBy('year');

        $datasets = [];
        $labels = $this->getMonthLabels();
        foreach ($formData as $year => $dataPerYear) {
            $yearData = array_fill(0, 12, 0);
            foreach ($dataPerYear as $data) {
                $monthIndex = $data->month - 1;
                $yearData[$monthIndex] = ceil($data->total / 10) * 10;
            }
            $datasets[] = [
                'label' => "Formulir per Bulan - $year",
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
        return 'line';
    }

    /**
     */
    private function getMonthLabels(): array
    {
        return ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'];
    }
}
