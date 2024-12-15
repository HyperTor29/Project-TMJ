<?php

namespace App\Filament\Verificator\Widgets;

use App\Models\Form;
use Carbon\Carbon;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Card;
use Illuminate\Support\Facades\Auth;

class CustomStatsOverview extends BaseWidget
{
    protected function getCards(): array
    {
        $userId = Auth::id();
        $userName = Auth::user()->name;

        $totalForms = Form::where(function ($query) use ($userId, $userName) {
            $query->where('user_id', $userId)
                ->orWhereHas('dataCs', fn ($q) => $q->where('user_id', $userId)->orWhere('nama', $userName))
                ->orWhereHas('dataCss', fn ($q) => $q->where('user_id', $userId)->orWhere('nama', $userName))
                ->orWhereHas('asmen', fn ($q) => $q->where('user_id', $userId)->orWhere('nama', $userName));
        })->count();

        $recentForms = Form::where(function ($query) use ($userId, $userName) {
            $query->where('user_id', $userId)
                ->orWhereHas('dataCs', fn ($q) => $q->where('user_id', $userId)->orWhere('nama', $userName))
                ->orWhereHas('dataCss', fn ($q) => $q->where('user_id', $userId)->orWhere('nama', $userName))
                ->orWhereHas('asmen', fn ($q) => $q->where('user_id', $userId)->orWhere('nama', $userName));
        })->where('created_at', '>=', Carbon::now()->subDays(7))->count();

        return [
            Card::make('Total Data Diverifikasi', $totalForms)
                ->description('Jumlah total data yang terkait Anda')
                ->descriptionIcon('heroicon-o-check-circle')
                ->color('primary'),

            Card::make('Data Baru Diverifikasi (7 Hari Terakhir)', $recentForms)
                ->description('Jumlah data baru yang diverifikasi dalam 7 hari terakhir')
                ->descriptionIcon('heroicon-o-calendar')
                ->color('success'),
        ];
    }
}
