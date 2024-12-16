<?php

namespace App\Filament\Validator\Widgets;

use Filament\Widgets\ChartWidget;
use App\Models\DetailLolos;

class BiayaChartWidget extends ChartWidget
{
    protected static ?string $heading = 'Total Biaya per Bulan';
    protected static ?int $sort = 4;

    protected function getData(): array
    {
        $biayaData = DetailLolos::selectRaw('MONTH(detail_lolos.created_at) as month, SUM(detail_lolos.jumlah_kdr * IFNULL(tarifs.tarif, 0)) as total')
            ->leftJoin('tarifs', function ($join) {
                $join->on('tarifs.gol_kdr_id', '=', 'detail_lolos.gol_kdr_id')
                    ->on('tarifs.gerbang_id', '=', 'detail_lolos.gerbang_id');
            })
            ->whereNull('detail_lolos.deleted_at')
            ->groupByRaw('MONTH(detail_lolos.created_at)')
            ->orderByRaw('MONTH(detail_lolos.created_at)')
            ->pluck('total', 'month')
            ->toArray();


        return [
            'datasets' => [
                [
                    'label' => 'Total Biaya (Rp)',
                    'data' => $this->fillMissingMonths($biayaData),
                    'borderWidth' => 2,
                ],
            ],
            'labels' => $this->getMonthLabels(),
        ];
    }

    protected function getType(): string
    {
        return 'line';
    }

    /**
     */
    private function fillMissingMonths(array $data): array
    {
        $fullData = [];
        for ($i = 1; $i <= 12; $i++) {
            $fullData[] = isset($data[$i]) ? round($data[$i]) : 0;
        }
        return $fullData;
    }

    /**
     */
    private function getMonthLabels(): array
    {
        return ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'];
    }
}
