<?php

namespace App\Filament\Viewer\Resources\GolKdrResource\Pages;

use App\Filament\Viewer\Resources\GolKdrResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListGolKdrs extends ListRecords
{
    protected static string $resource = GolKdrResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
