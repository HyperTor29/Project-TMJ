<?php

namespace App\Filament\Validator\Widgets;

use Filament\Widgets\ChartWidget;
use App\Models\DetailLolos;

class KendaraanPerGerbangChartWidget extends ChartWidget
{
    protected static ?string $heading = 'Jumlah Total Kendaraan per Gerbang';
    protected static ?int $sort = 5;

    protected function getData(): array
    {
        $gerbangData = DetailLolos::with('Gerbang')
            ->get()
            ->groupBy(fn($item) => $item->Gerbang->name ?? 'Unknown')
            ->map(fn($items) => $items->sum('jumlah_kdr'))
            ->toArray();

        return [
            'datasets' => [
                [
                    'label' => 'Jumlah Kendaraan',
                    'data' => array_values($gerbangData),
                    'backgroundColor' => ['#F87171', '#60A5FA', '#34D399', '#FBBF24', '#A78BFA'],
                ],
            ],
            'labels' => array_keys($gerbangData),
        ];
    }

    protected function getType(): string
    {
        return 'pie';
    }
}
