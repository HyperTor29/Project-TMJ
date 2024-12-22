<?php

namespace App\Filament\Viewer\Widgets;

use Filament\Widgets\ChartWidget;
use App\Models\DetailLolos;

class BiayaChartWidget extends ChartWidget
{
    protected static ?string $heading = 'Potensi Kerugian TMJ per Bulan';
    protected static ?int $sort = 3;

    protected function getData(): array
    {
        $biayaData = DetailLolos::selectRaw('
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
            ->groupByRaw('YEAR(detail_lolos.created_at), MONTH(detail_lolos.created_at)')
            ->orderByRaw('YEAR(detail_lolos.created_at), MONTH(detail_lolos.created_at)')
            ->get()
            ->groupBy('year');

        $datasets = [];
        $labels = $this->getMonthLabels();
        foreach ($biayaData as $year => $dataPerYear) {
            $yearData = array_fill(0, 12, 0);
            foreach ($dataPerYear as $data) {
                $yearData[$data->month - 1] = round($data->total);
            }
            $datasets[] = [
                'label' => "Total Biaya (Rp) - $year",
                'data' => $yearData,
                'borderWidth' => 2,
            ];
        }

        return [
            'datasets' => $datasets,
            'labels' => $labels,
        ];
    }

    protected function getType(): string
    {
        return 'line';
    }

    /**
     */
    private function getMonthLabels(): array
    {
        return ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'];
    }
}
