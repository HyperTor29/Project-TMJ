<?php

namespace App\Filament\Viewer\Resources\DataSecurityResource\Pages;

use App\Filament\Viewer\Resources\DataSecurityResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListDataSecurities extends ListRecords
{
    protected static string $resource = DataSecurityResource::class;

    protected function getHeaderActions(): array
    {
        return [
            // Actions\CreateAction::make(),
        ];
    }
}
