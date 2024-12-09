<?php

namespace App\Filament\Viewer\Resources\DataCssResource\Pages;

use App\Filament\Viewer\Resources\DataCssResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListDataCsses extends ListRecords
{
    protected static string $resource = DataCssResource::class;

    protected function getHeaderActions(): array
    {
        return [
            // Actions\CreateAction::make(),
        ];
    }
}
