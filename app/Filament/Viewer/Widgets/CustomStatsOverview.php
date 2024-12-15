<?php

namespace App\Filament\Viewer\Widgets;

use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Card;
use App\Models\Form;
use Carbon\Carbon;

class CustomStatsOverview extends BaseWidget
{
    protected function getCards(): array
    {
        $totalForms = Form::count();
        $recentForms = Form::where('created_at', '>=', Carbon::now()->subDays(7))->count();

        return [
            Card::make('Total Akun', \App\Models\User::count())
                ->description('Total pengguna di sistem')
                ->descriptionIcon('heroicon-s-user-group')
                ->color('primary'),

            Card::make('Total Customer Service', \App\Models\DataCs::count())
                ->description('Jumlah customer service')
                ->descriptionIcon('heroicon-s-briefcase')
                ->color('success'),

            Card::make('Total CS Supervisor', \App\Models\DataCss::count())
                ->description('Jumlah supervisor CS')
                ->descriptionIcon('heroicon-s-user-circle')
                ->color('warning'),

            Card::make('Total Assistant Manager', \App\Models\Asmen::count())
                ->description('Jumlah Assistant Manager')
                ->descriptionIcon('heroicon-s-user')
                ->color('danger'),

            Card::make('Total Formulir', $totalForms)
                ->description('Jumlah total formulir yang telah dibuat')
                ->descriptionIcon('heroicon-s-document-text')
                ->color('info'),

            Card::make('Formulir Baru (7 Hari Terakhir)', $recentForms)
                ->description('Formulir yang dibuat dalam 7 hari terakhir')
                ->descriptionIcon('heroicon-s-clock')
                ->color('success'),
        ];
    }
}
