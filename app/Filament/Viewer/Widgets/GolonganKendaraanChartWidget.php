<?php

namespace App\Filament\Viewer\Widgets;

use Filament\Widgets\ChartWidget;
use App\Models\DetailLolos;
use App\Models\Form;
use Carbon\Carbon;

class GolonganKendaraanChartWidget extends ChartWidget
{
    protected static ?string $heading = 'Jumlah Total Kendaraan per Golongan';

    protected static string $yellowColor = '#FBBF24';

    protected function getData(): array
    {
        $selectedYear = $this->filter ?? Carbon::now()->year;

        $activeFormIds = Form::whereNull('deleted_at')
            ->whereYear('created_at', $selectedYear)
            ->pluck('id')
            ->toArray();

        $query = DetailLolos::with('GolKdr')
            ->whereIn('form_id', $activeFormIds)
            ->whereNull('deleted_at')
            ->whereYear('created_at', $selectedYear);

        $rawData = $query->get()
            ->groupBy(fn($item) => $item->GolKdr->golongan ?? 'Unknown')
            ->map(fn($items) => $items->sum('jumlah_kdr'))
            ->toArray();

        $sortedGolongan = [];
        $sortedJumlah = [];
        $backgroundColors = [];

        for ($i = 1; $i <= 5; $i++) {
            $golongan = (string)$i;
            $sortedGolongan[] = "Golongan $golongan";
            $sortedJumlah[] = $rawData[$golongan] ?? 0;
            $backgroundColors[] = self::$yellowColor;
        }

        if (isset($rawData['Unknown']) && $rawData['Unknown'] > 0) {
            $sortedGolongan[] = 'Tidak Diketahui';
            $sortedJumlah[] = $rawData['Unknown'];
            $backgroundColors[] = self::$yellowColor;
        }

        return [
            'datasets' => [
                [
                    'label' => 'Jumlah Kendaraan',
                    'data' => $sortedJumlah,
                    'backgroundColor' => $backgroundColors,
                ],
            ],
            'labels' => $sortedGolongan,
            'options' => [
                'scales' => [
                    'x' => [
                        'title' => [
                            'display' => true,
                            'text' => 'Golongan Kendaraan',
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
                'plugins' => [
                    'legend' => [
                        'display' => false,
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
}
