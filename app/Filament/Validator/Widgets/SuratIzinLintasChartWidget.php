<?php

namespace App\Filament\Validator\Widgets;

use Filament\Widgets\ChartWidget;
use App\Models\DetailLolos;
use App\Models\Form;
use Carbon\Carbon;

class SuratIzinLintasChartWidget extends ChartWidget
{
    protected static ?string $heading = 'Persentase dengan Surat Izin Lintas';
    protected static ?int $sort = 3;

    protected function getData(): array
    {
        $selectedYear = $this->filter ?? Carbon::now()->year;

        $activeFormIds = Form::whereNull('deleted_at')
            ->whereYear('created_at', $selectedYear)
            ->pluck('id')
            ->toArray();

        $query = DetailLolos::selectRaw('surat_izin_lintas, COUNT(*) as total')
            ->whereIn('form_id', $activeFormIds)
            ->whereNull('deleted_at')
            ->whereYear('created_at', $selectedYear)
            ->groupBy('surat_izin_lintas');

        $suratData = $query->pluck('total', 'surat_izin_lintas')
            ->toArray();

        $totalKendaraan = array_sum($suratData);

        $data = [
            $totalKendaraan > 0 ? round(($suratData[1] ?? 0) / $totalKendaraan * 100, 2) : 0,
            $totalKendaraan > 0 ? round(($suratData[0] ?? 0) / $totalKendaraan * 100, 2) : 0,
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
            'options' => [
                'plugins' => [
                    'legend' => [
                        'position' => 'bottom',
                    ],
                    'tooltip' => [
                        'callbacks' => [
                            'label' => 'function(context) { return context.label + ": " + context.raw + "%"; }',
                        ],
                    ],
                ],
                'cutout' => '60%',
            ],
        ];
    }

    protected function getType(): string
    {
        return 'doughnut';
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
}

