<?php

namespace App\Filament\Validator\Resources\DetailLolosResource\Pages;

use App\Filament\Validator\Resources\DetailLolosResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListDetailLolos extends ListRecords
{
    protected static string $resource = DetailLolosResource::class;

    protected function getHeaderActions(): array
    {
        return [
            // Actions\CreateAction::make(),
        ];
    }
}
