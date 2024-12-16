<?php

namespace App\Filament\Validator\Widgets;

use Filament\Widgets\ChartWidget;
use App\Models\DetailLolos;

class GolonganKendaraanChartWidget extends ChartWidget
{
    protected static ?string $heading = 'Jumlah Kendaraan per Golongan';

    protected function getData(): array
    {
        $golonganData = DetailLolos::with('GolKdr')
            ->get()
            ->groupBy(fn($item) => $item->GolKdr->golongan ?? 'Unknown')
            ->map(fn($items) => $items->sum('jumlah_kdr'))
            ->toArray();

        return [
            'datasets' => [
                [
                    'label' => 'Jumlah Kendaraan',
                    'data' => array_values($golonganData),
                    'backgroundColor' => ['#F87171', '#60A5FA', '#34D399', '#FBBF24', '#A78BFA'],
                ],
            ],
            'labels' => array_keys($golonganData),
        ];
    }

    protected function getType(): string
    {
        return 'bar';
    }
}
