<?php

namespace App\Filament\Viewer\Resources\FormResource\Pages;

use App\Filament\Viewer\Resources\FormResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListForms extends ListRecords
{
    protected static string $resource = FormResource::class;

    protected function getHeaderActions(): array
    {
        return [
            // Actions\CreateAction::make(),
        ];
    }
}
