<?php

namespace App\Filament\Validator\Widgets;

use Filament\Widgets\ChartWidget;
use App\Models\User;

class UsersChartWidget extends ChartWidget
{
    protected static ?string $heading = 'Pengguna per Bulan';

    protected function getData(): array
    {
        $userData = User::selectRaw('MONTH(created_at) as month, COUNT(*) as total')
            ->groupBy('month')
            ->orderBy('month')
            ->pluck('total', 'month')
            ->toArray();

        return [
            'datasets' => [
                [
                    'label' => 'Pengguna per Bulan',
                    'data' => $this->fillMissingMonths($userData),
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
        $fullData = [];
        for ($i = 1; $i <= 12; $i++) {
            $fullData[] = $data[$i] ?? 0;
        }
        return $fullData;
    }

    private function getMonthLabels(): array
    {
        return ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'];
    }
}
