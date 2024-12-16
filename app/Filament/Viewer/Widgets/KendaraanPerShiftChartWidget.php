<?php

namespace App\Filament\Viewer\Widgets;

use Filament\Widgets\ChartWidget;
use App\Models\DetailLolos;

class KendaraanPerShiftChartWidget extends ChartWidget
{
    protected static ?string $heading = 'Jumlah Kendaraan per Shift';

    protected function getData(): array
    {
        $shiftData = DetailLolos::with('Shifts')->get()
            ->groupBy(fn($item) => $item->Shifts->Shift ?? 'Unknown')
            ->map(fn($items) => $items->sum('jumlah_kdr'))
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
