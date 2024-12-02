<?php

namespace App\Filament\User\Resources\DetailLolosResource\Pages;

use App\Filament\User\Resources\DetailLolosResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListDetailLolos extends ListRecords
{
    protected static string $resource = DetailLolosResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
