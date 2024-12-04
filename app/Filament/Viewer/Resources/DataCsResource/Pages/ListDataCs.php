<?php

namespace App\Filament\Viewer\Resources\DataCsResource\Pages;

use App\Filament\Viewer\Resources\DataCsResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListDataCs extends ListRecords
{
    protected static string $resource = DataCsResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
