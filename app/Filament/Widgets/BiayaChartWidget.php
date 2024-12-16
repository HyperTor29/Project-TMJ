<?php

namespace App\Filament\Widgets;

use Filament\Widgets\ChartWidget;
use App\Models\DetailLolos;
use App\Models\Tarif;

class BiayaChartWidget extends ChartWidget
{
    protected static ?string $heading = 'Total Biaya per Bulan';
    protected static ?int $sort = 4;

    protected function getData(): array
    {
        $biayaData = DetailLolos::selectRaw('MONTH(created_at) as month')
            ->with(['GolKdr', 'Gerbang'])
            ->get()
            ->groupBy(fn($item) => $item->created_at ? $item->created_at->format('m') : 'unknown')
            ->map(function ($details) {
                return $details->sum(function ($detail) {
                    $tarif = Tarif::whereHas('GolKdr', fn($q) => $q->where('golongan', $detail->GolKdr->golongan ?? null))
                        ->whereHas('Gerbang', fn($q) => $q->where('name', $detail->Gerbang->name ?? null))
                        ->first();

                    return $tarif ? $tarif->tarif * $detail->jumlah_kdr : 0;
                });
            })
            ->toArray();

        return [
            'datasets' => [
                [
                    'label' => 'Total Biaya',
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

    private function fillMissingMonths(array $data): array
    {
        return array_map(fn($i) => $data[$i] ?? 0, range(1, 12));
    }

    private function getMonthLabels(): array
    {
        return ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'];
    }
}
