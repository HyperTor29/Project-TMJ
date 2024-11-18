<?php

namespace App\Filament\Resources\DataCssResource\Pages;

use App\Filament\Resources\DataCssResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListDataCsses extends ListRecords
{
    protected static string $resource = DataCssResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }

    public function getTitle(): string
    {
        return "Data CSS";
    }
}
