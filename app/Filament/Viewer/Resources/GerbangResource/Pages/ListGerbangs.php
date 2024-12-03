<?php

namespace App\Filament\Viewer\Resources\GerbangResource\Pages;

use App\Filament\Viewer\Resources\GerbangResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListGerbangs extends ListRecords
{
    protected static string $resource = GerbangResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
