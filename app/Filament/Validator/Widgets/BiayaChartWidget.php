<?php

namespace App\Filament\Validator\Widgets;

use Filament\Widgets\ChartWidget;
use App\Models\DetailLolos;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class BiayaChartWidget extends ChartWidget
{
    protected static ?string $heading = 'Nilai Rupiah Transaksi Izin Lintas per Bulan TMJ';
    protected static ?int $sort = 3;

    protected function getData(): array
    {
        $selectedYear = $this->filter ?? Carbon::now()->year;

        $query = DetailLolos::selectRaw('
                YEAR(detail_lolos.created_at) as year,
                MONTH(detail_lolos.created_at) as month,
                SUM(detail_lolos.jumlah_kdr * IFNULL(tarifs.tarif, 0)) as total
            ')
            ->join('forms', 'forms.id', '=', 'detail_lolos.form_id')
            ->leftJoin('tarifs', function ($join) {
                $join->on('tarifs.gol_kdr_id', '=', 'detail_lolos.gol_kdr_id')
                    ->on('tarifs.gerbang_id', '=', 'detail_lolos.gerbang_id')
                    ->on('tarifs.gerbang_tujuan_id', '=', 'forms.gerbang_tujuan_id');
            })
            ->whereNull('detail_lolos.deleted_at')
            ->whereNull('forms.deleted_at');

        if ($selectedYear) {
            $query->whereYear('detail_lolos.created_at', $selectedYear);
        }

        $biayaData = $query->groupByRaw('YEAR(detail_lolos.created_at), MONTH(detail_lolos.created_at)')
            ->orderByRaw('YEAR(detail_lolos.created_at), MONTH(detail_lolos.created_at)')
            ->get()
            ->groupBy('year');

        $datasets = [];
        $labels = $this->getMonthLabels();

        $color = '#8B5CF6';

        foreach ($biayaData as $year => $dataPerYear) {
            $yearData = array_fill(0, 12, 0);
            foreach ($dataPerYear as $data) {
                $yearData[$data->month - 1] = round($data->total);
            }

            $datasets[] = [
                'label' => $selectedYear ? "Total Nilai Rupiah" : "Total Nilai Rupiah - $year",
                'data' => $yearData,
                'borderColor' => $color,
                'backgroundColor' => $color . '33',
                'fill' => true,
                'tension' => 0.4,
                'borderWidth' => 2,
            ];
        }

        if (empty($datasets)) {
            $datasets[] = [
                'label' => "Total Nilai Rupiah",
                'data' => array_fill(0, 12, 0),
                'borderColor' => $color,
                'backgroundColor' => $color . '33',
                'fill' => true,
                'tension' => 0.4,
                'borderWidth' => 2,
            ];
        }

        return [
            'datasets' => $datasets,
            'labels' => $labels,
            'options' => [
                'scales' => [
                    'x' => [
                        'title' => [
                            'display' => true,
                            'text' => 'Bulan',
                        ],
                    ],
                    'y' => [
                        'title' => [
                            'display' => true,
                            'text' => 'Total Nilai (Rp)',
                        ],
                        'beginAtZero' => true,
                        'ticks' => [
                            'callback' => 'function(value) { return new Intl.NumberFormat("id-ID", { style: "currency", currency: "IDR", maximumFractionDigits: 0 }).format(value); }',
                        ],
                    ],
                ],
                'plugins' => [
                    'tooltip' => [
                        'callbacks' => [
                            'label' => 'function(context) { return new Intl.NumberFormat("id-ID", { style: "currency", currency: "IDR", maximumFractionDigits: 0 }).format(context.raw); }',
                        ],
                    ],
                ],
            ],
        ];
    }

    protected function getType(): string
    {
        return 'line';
    }

    protected function getFilters(): ?array
    {
        $currentYear = Carbon::now()->year;

        $years = DetailLolos::selectRaw('YEAR(detail_lolos.created_at) as year')
            ->join('forms', 'forms.id', '=', 'detail_lolos.form_id')
            ->whereNull('detail_lolos.deleted_at')
            ->whereNull('forms.deleted_at')
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

    private function getMonthLabels(): array
    {
        return ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Ags', 'Sep', 'Okt', 'Nov', 'Des'];
    }
}

