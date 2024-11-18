<?php

namespace App\Filament\Resources\AsmenResource\Pages;

use App\Filament\Resources\AsmenResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListAsmens extends ListRecords
{
    protected static string $resource = AsmenResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }

    public function getTitle(): string
    {
        return "Data Asmen";
    }
}
