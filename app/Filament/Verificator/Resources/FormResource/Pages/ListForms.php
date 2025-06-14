<?php

namespace App\Filament\Verificator\Resources\FormResource\Pages;

use App\Filament\Verificator\Resources\FormResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListForms extends ListRecords
{
    protected static string $resource = FormResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make()
            ->label('New Form'),
        ];
    }
}
