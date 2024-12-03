<?php

namespace App\Filament\Viewer\Resources\TarifResource\Pages;

use App\Filament\Viewer\Resources\TarifResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListTarifs extends ListRecords
{
    protected static string $resource = TarifResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
