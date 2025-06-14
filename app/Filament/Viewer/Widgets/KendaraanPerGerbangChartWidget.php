<?php

namespace App\Filament\Viewer\Widgets;

use Filament\Widgets\ChartWidget;
use App\Models\DetailLolos;
use App\Models\Form;
use Carbon\Carbon;

class KendaraanPerGerbangChartWidget extends ChartWidget
{
    protected static ?string $heading = 'Jumlah Total Kendaraan per Gerbang Tujuan Wilayah TMJ';
    protected static ?int $sort = 5;
    protected static array $allowedGerbang = [
        'Banyumanik', 'Ungaran', 'Bawen', 'Salatiga', 'Boyolali'
    ];
    protected function getData(): array
    {
        $selectedYear = $this->filter ?? Carbon::now()->year;

        $query = Form::with('GerbangTujuan')
            ->whereNull('deleted_at')
            ->whereYear('created_at', $selectedYear)
            ->whereHas('GerbangTujuan', function($query) {
                $query->whereIn('name', self::$allowedGerbang);
            });

        $formData = $query->get();

        $gerbangTujuanData = [];
        foreach (self::$allowedGerbang as $gerbang) {
            $gerbangTujuanData[$gerbang] = 0;
        }

        foreach ($formData as $form) {
            $gerbangTujuan = $form->GerbangTujuan->name ?? 'Unknown';

            if (!in_array($gerbangTujuan, self::$allowedGerbang)) {
                continue;
            }

            $totalKendaraan = DetailLolos::where('form_id', $form->id)
                ->whereNull('deleted_at')
                ->sum('jumlah_kdr');

            $gerbangTujuanData[$gerbangTujuan] += $totalKendaraan;
        }

        $sortedData = [];
        $sortedLabels = [];

        foreach (self::$allowedGerbang as $gerbang) {
            $sortedLabels[] = $gerbang;
            $sortedData[] = $gerbangTujuanData[$gerbang];
        }

        $colors = [
            'Banyumanik' => '#F87171',
            'Ungaran' => '#60A5FA',
            'Bawen' => '#34D399',
            'Salatiga' => '#FBBF24',
            'Boyolali' => '#A78BFA',
        ];

        $backgroundColors = [];
        foreach ($sortedLabels as $label) {
            $backgroundColors[] = $colors[$label] ?? $this->generateRandomColor();
        }

        return [
            'datasets' => [
                [
                    'label' => 'Jumlah Kendaraan',
                    'data' => $sortedData,
                    'backgroundColor' => $backgroundColors,
                ],
            ],
            'labels' => $sortedLabels,
            'options' => [
                'plugins' => [
                    'legend' => [
                        'position' => 'right',
                        'labels' => [
                            'font' => [
                                'size' => 12
                            ]
                        ]
                    ],
                    'tooltip' => [
                        'callbacks' => [
                            'label' => 'function(context) { return context.label + ": " + context.raw + " kendaraan"; }',
                        ],
                    ],
                ],
            ],
        ];
    }

    protected function getType(): string
    {
        return 'pie';
    }

    protected function getFilters(): ?array
    {
        $currentYear = Carbon::now()->year;

        $years = Form::whereHas('GerbangTujuan', function($query) {
                $query->whereIn('name', self::$allowedGerbang);
            })
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

    private function generateRandomColor(): string
    {
        return '#' . str_pad(dechex(mt_rand(0, 0xFFFFFF)), 6, '0', STR_PAD_LEFT);
    }
}
