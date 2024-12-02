<?php

namespace App\Filament\Verificator\Resources\RekapResource\Pages;

use App\Filament\Verificator\Resources\RekapResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListRekaps extends ListRecords
{
    protected static string $resource = RekapResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
