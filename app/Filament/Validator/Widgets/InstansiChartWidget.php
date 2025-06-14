<?php

namespace App\Filament\Validator\Widgets;

use Filament\Widgets\ChartWidget;
use App\Models\DetailLolos;
use App\Models\Form;
use Illuminate\Support\Collection;

class InstansiChartWidget extends ChartWidget
{
    protected static ?string $heading = 'Jumlah Kendaraan tiap Instansi per Bulan';

    protected static array $defaultInstansiColors = [
        // Contoh: 'Kepolisian' => '#F87171',
        // Tambahkan instansi lain jika diperlukan
    ];

    protected function getData(): array
    {
        $selectedYear = $this->filter ?? now()->year;

        $activeFormIds = Form::whereNull('deleted_at')
            ->whereYear('created_at', $selectedYear)
            ->pluck('id')
            ->toArray();

        $instansiData = DetailLolos::with('Instansi')
            ->whereIn('form_id', $activeFormIds)
            ->whereNull('deleted_at')
            ->whereYear('created_at', $selectedYear)
            ->get()
            ->groupBy(fn($detail) => $detail->Instansi->instansi ?? 'Tidak Diketahui');

        $datasets = [];

        $instansiNames = $instansiData->keys()->toArray();

        $instansiColorMap = $this->generateDistinctColors($instansiNames);

        foreach ($instansiData as $instansiName => $details) {
            $monthlyData = array_fill(0, 12, 0);

            foreach ($details as $detail) {
                $monthIndex = $detail->created_at->month - 1;
                $monthlyData[$monthIndex] += $detail->jumlah_kdr ?? 1;
            }

            $color = static::$defaultInstansiColors[$instansiName] ?? $instansiColorMap[$instansiName] ?? 'rgba(0,0,0,0.7)';

            $datasets[] = [
                'label' => $instansiName,
                'data' => $monthlyData,
                'backgroundColor' => $color,
                'borderColor' => $color,
                'borderWidth' => 1,
            ];
        }

        return [
            'datasets' => $datasets,
            'labels' => $this->getMonthLabels(),
        ];
    }

    protected function getType(): string
    {
        return 'bar';
    }

    protected function getFilters(): ?array
    {
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

        if (empty($years)) {
            $years = [now()->year];
        }

        $formattedYears = [];
        foreach ($years as $year) {
            $formattedYears[(string)$year] = (string)$year;
        }

        return $formattedYears;
    }

    protected function getMonthLabels(): array
    {
        return ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Ags', 'Sep', 'Okt', 'Nov', 'Des'];
    }

    private function generateDistinctColors(array $labels): array
    {
        $colors = [];
        $count = count($labels);

        if ($count === 0) {
            return $colors;
        }

        $hueStep = 360 / max(1, $count);
        $saturation = 70;
        $lightness = 60;

        foreach ($labels as $i => $label) {
            $hue = $i * $hueStep;
            $colors[$label] = "hsla($hue, {$saturation}%, {$lightness}%, 0.8)";
        }

        return $colors;
    }
}
