<?php

namespace App\Filament\Widgets;

use Filament\Widgets\Widget;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;

class CustomStatsOverview extends BaseWidget
{
    protected static string $view = 'filament.widgets.custom-stats-overview';

    public function getData(): array
    {
        return [
            'totalUsers' => \App\Models\User::count(),
            'totalDataCs' => \App\Models\DataCs::count(),
            'totalDataCss' => \App\Models\DataCss::count(),
            'totalAsmen' => \App\Models\Asmen::count(),
        ];
    }

    protected function getViewData(): array
    {
        return $this->getData();
    }
}
