<?php

namespace App\Filament\Validator\Widgets;

use Filament\Widgets\ChartWidget;
use App\Models\Form;

class FormsChartWidget extends ChartWidget
{
    protected static ?string $heading = 'Formulir per Bulan';

    protected function getData(): array
    {
        $formData = Form::selectRaw('MONTH(created_at) as month, COUNT(*) as total')
            ->groupBy('month')
            ->orderBy('month')
            ->pluck('total', 'month')
            ->toArray();

        return [
            'datasets' => [
                [
                    'label' => 'Formulir per Bulan',
                    'data' => $this->fillMissingMonths($formData),
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
        return array_map(fn($i) => isset($data[$i]) ? floor($data[$i]) : 0, range(1, 12));
    }

    private function getMonthLabels(): array
    {
        return ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'];
    }
}
