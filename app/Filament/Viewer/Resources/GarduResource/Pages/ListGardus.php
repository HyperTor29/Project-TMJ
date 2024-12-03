<?php

namespace App\Filament\Viewer\Resources\GarduResource\Pages;

use App\Filament\Viewer\Resources\GarduResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListGardus extends ListRecords
{
    protected static string $resource = GarduResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
