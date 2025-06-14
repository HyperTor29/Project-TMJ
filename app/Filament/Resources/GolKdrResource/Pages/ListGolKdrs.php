<?php

namespace App\Filament\Resources\GolKdrResource\Pages;

use App\Filament\Resources\GolKdrResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListGolKdrs extends ListRecords
{
    protected static string $resource = GolKdrResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make()
            ->label('New Golongan'),
        ];
    }

    public function getTitle(): string
    {
        return "Golongan Kendaraan";
    }
}
