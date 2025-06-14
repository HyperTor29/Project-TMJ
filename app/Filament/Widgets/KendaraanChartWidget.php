<?php

namespace App\Filament\Widgets;

use Filament\Widgets\ChartWidget;
use App\Models\DetailLolos;
use App\Models\Form;
use Carbon\Carbon;

class KendaraanChartWidget extends ChartWidget
{
    protected static ?string $heading = 'Jumlah Total Kendaraan per Bulan';

    protected function getData(): array
    {
        $selectedYear = $this->filter ?? Carbon::now()->year;

        $activeFormIds = Form::whereNull('deleted_at')
            ->whereYear('created_at', $selectedYear)
            ->pluck('id')
            ->toArray();

        $query = DetailLolos::selectRaw('YEAR(created_at) as year, MONTH(created_at) as month, SUM(jumlah_kdr) as total')
            ->whereIn('form_id', $activeFormIds)
            ->whereNull('deleted_at')
            ->groupByRaw('YEAR(created_at), MONTH(created_at)')
            ->orderByRaw('YEAR(created_at), MONTH(created_at)');

        if ($selectedYear) {
            $query->whereYear('created_at', $selectedYear);
        }

        $kendaraanData = $query->get()
            ->groupBy('year');

        $labels = $this->getMonthLabels();
        $datasets = [];

        $blueColor = '#3B82F6';

        $i = 0;
        foreach ($kendaraanData as $year => $dataPerYear) {
            $yearData = array_fill(0, 12, 0);

            foreach ($dataPerYear as $data) {
                $yearData[$data->month - 1] = $data->total;
            }

            $datasets[] = [
                'label' => $selectedYear ? "Jumlah Kendaraan" : "Jumlah Kendaraan - $year",
                'data' => $yearData,
                'backgroundColor' => $blueColor,
                'borderWidth' => 1,
            ];

            $i++;
        }

        if (empty($datasets)) {
            $datasets[] = [
                'label' => "Jumlah Kendaraan",
                'data' => array_fill(0, 12, 0),
                'backgroundColor' => $blueColor,
                'borderWidth' => 1,
            ];
        }

        return [
            'datasets' => $datasets,
            'labels' => $labels,
            'options' => [
                'scales' => [
                    'x' => [
                        'title' => [
                            'display' => true,
                            'text' => 'Bulan',
                        ],
                    ],
                    'y' => [
                        'title' => [
                            'display' => true,
                            'text' => 'Jumlah Kendaraan',
                        ],
                        'beginAtZero' => true,
                    ],
                ],
            ],
        ];
    }

    protected function getType(): string
    {
        return 'bar';
    }

    protected function getFilters(): ?array
    {
        $currentYear = Carbon::now()->year;

        $activeFormIds = Form::whereNull('deleted_at')
            ->pluck('id')
            ->toArray();

        $years = DetailLolos::whereIn('form_id', $activeFormIds)
            ->whereNull('deleted_at')
            ->selectRaw('YEAR(created_at) as year')
            ->distinct()
            ->orderByDesc('year')
            ->pluck('year')
            ->toArray();

        if (!in_array($currentYear, $years)) {
            $years[] = $currentYear;
            sort($years);
            rsort($years);
        }

        if (empty($years)) {
            $years = [$currentYear];
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
