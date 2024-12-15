<?php

namespace App\Filament\User\Widgets;

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
            Card::make('Total Formulir', $totalForms)
                ->description('Jumlah total formulir terkait Anda')
                ->descriptionIcon('heroicon-o-clipboard')
                ->color('primary'),

            Card::make('Formulir Baru (7 Hari Terakhir)', $recentForms)
                ->description('Formulir baru yang dibuat dalam 7 hari terakhir')
                ->descriptionIcon('heroicon-o-calendar')
                ->color('success'),
        ];
    }

    protected function getViewData(): array
    {
        $userId = Auth::id();

        $forms = Form::selectRaw('DATE(created_at) as date, COUNT(*) as count')
            ->where(function ($query) use ($userId) {
                $query->where('user_id', $userId)
                    ->orWhereHas('dataCs', fn ($q) => $q->where('user_id', $userId))
                    ->orWhereHas('dataCss', fn ($q) => $q->where('user_id', $userId))
                    ->orWhereHas('asmen', fn ($q) => $q->where('user_id', $userId));
            })
            ->groupBy('date')
            ->orderBy('date', 'asc')
            ->get();

        $labels = $forms->pluck('date')->map(fn ($date) => Carbon::parse($date)->format('d M Y'));
        $data = $forms->pluck('count');

        return [
            'labels' => $labels,
            'data' => $data,
        ];
    }
}
