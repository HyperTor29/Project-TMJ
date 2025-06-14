<?php

namespace App\Filament\Resources\GerbangTujuanResource\Pages;

use App\Filament\Resources\GerbangTujuanResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListGerbangTujuans extends ListRecords
{
    protected static string $resource = GerbangTujuanResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make()
            ->label('New Gerbang Tujuan'),
        ];
    }

    public function getTitle(): string
    {
        return "Daftar Gerbang Tujuan";
    }
}
