<?php

namespace App\Filament\Viewer\Widgets;

use Filament\Widgets\ChartWidget;
use App\Models\DetailLolos;

class SuratIzinLintasChartWidget extends ChartWidget
{
    protected static ?string $heading = 'Persentase dengan Surat Izin Lintas';
    protected static ?int $sort = 3;

    protected function getData(): array
    {
        $suratData = DetailLolos::selectRaw('surat_izin_lintas, COUNT(*) as total')
            ->groupBy('surat_izin_lintas')
            ->pluck('total', 'surat_izin_lintas')
            ->toArray();

        $totalKendaraan = array_sum($suratData);

        $data = [
            $totalKendaraan > 0 ? round(($suratData[1] ?? 0) / $totalKendaraan * 100, 2) : 0, // Ya
            $totalKendaraan > 0 ? round(($suratData[0] ?? 0) / $totalKendaraan * 100, 2) : 0, // Tidak
        ];

        return [
            'datasets' => [
                [
                    'label' => 'Persentase Kendaraan (%)',
                    'data' => $data,
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
