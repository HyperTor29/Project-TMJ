<?php

namespace App\Filament\Widgets;

use Filament\Widgets\ChartWidget;
use App\Models\DetailLolos;

class SuratIzinLintasChartWidget extends ChartWidget
{
    protected static ?string $heading = 'Surat Izin Lintas Kendaraan';
    protected static ?int $sort = 3;

    protected function getData(): array
    {
        $suratData = DetailLolos::selectRaw('surat_izin_lintas, COUNT(*) as total')
            ->groupBy('surat_izin_lintas')
            ->pluck('total', 'surat_izin_lintas')
            ->toArray();

        return [
            'datasets' => [
                [
                    'label' => 'Jumlah Kendaraan',
                    'data' => [
                        $suratData[1] ?? 0, // Ya
                        $suratData[0] ?? 0, // Tidak
                    ],
                    'backgroundColor' => ['#34D399', '#F87171'],
                ],
            ],
            'labels' => ['Ya', 'Tidak'],
        ];
    }

    protected function getType(): string
    {
        return 'doughnut';
    }
}
