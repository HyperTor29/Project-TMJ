<?php

namespace App\Filament\Viewer\Widgets;

use Filament\Widgets\ChartWidget;
use App\Models\DetailLolos;

class KendaraanPerShiftChartWidget extends ChartWidget
{
    protected static ?string $heading = 'Jumlah Total Kendaraan per Shift';

    protected function getData(): array
    {
        $shiftData = DetailLolos::selectRaw('forms.shift_id as shift, SUM(detail_lolos.jumlah_kdr) as total_kendaraan')
            ->join('forms', 'forms.id', '=', 'detail_lolos.form_id')
            ->groupBy('forms.shift_id')
            ->orderBy('forms.shift_id')
            ->get()
            ->pluck('total_kendaraan', 'shift')
            ->toArray();

        return [
            'datasets' => [
                [
                    'label' => 'Jumlah Kendaraan',
                    'data' => array_values($shiftData),
                    'backgroundColor' => ['#60A5FA', '#34D399', '#FBBF24'],
                ],
            ],
            'labels' => array_keys($shiftData),
        ];
    }

    protected function getType(): string
    {
        return 'bar';
    }
}
