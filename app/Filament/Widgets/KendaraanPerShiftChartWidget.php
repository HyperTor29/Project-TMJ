<?php

namespace App\Filament\Widgets;

use Filament\Widgets\ChartWidget;
use App\Models\DetailLolos;
use App\Models\Form;
use Carbon\Carbon;

class KendaraanPerShiftChartWidget extends ChartWidget
{
    protected static ?string $heading = 'Jumlah Total Kendaraan per Shift';

    protected function getData(): array
    {
        $selectedYear = $this->filter ?? Carbon::now()->year;

        $query = DetailLolos::selectRaw('forms.shift_id as shift, SUM(detail_lolos.jumlah_kdr) as total_kendaraan')
            ->join('forms', 'forms.id', '=', 'detail_lolos.form_id')
            ->whereNull('forms.deleted_at')
            ->whereNull('detail_lolos.deleted_at')
            ->whereYear('detail_lolos.created_at', $selectedYear)
            ->groupBy('forms.shift_id');

        $rawData = $query->get()
            ->pluck('total_kendaraan', 'shift')
            ->toArray();

        $shifts = [1, 2, 3];
        $jumlahKendaraan = [];
        $shiftLabels = ['Shift 1', 'Shift 2', 'Shift 3'];
        $greenColor = '#10B981';

        foreach ($shifts as $index => $shift) {
            $jumlahKendaraan[] = $rawData[$shift] ?? 0;
        }

        return [
            'datasets' => [
                [
                    'label' => 'Jumlah Kendaraan',
                    'data' => $jumlahKendaraan,
                    'backgroundColor' => $greenColor,
                ],
            ],
            'labels' => $shiftLabels,
            'options' => [
                'scales' => [
                    'x' => [
                        'title' => [
                            'display' => true,
                            'text' => 'Shift',
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

        $years = DetailLolos::selectRaw('YEAR(detail_lolos.created_at) as year')
            ->join('forms', 'forms.id', '=', 'detail_lolos.form_id')
            ->whereNull('forms.deleted_at')
            ->whereNull('detail_lolos.deleted_at')
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
}
