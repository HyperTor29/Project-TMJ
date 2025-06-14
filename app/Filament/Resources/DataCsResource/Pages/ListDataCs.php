<?php

namespace App\Filament\Resources\DataCsResource\Pages;

use App\Filament\Resources\DataCsResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListDataCs extends ListRecords
{
    protected static string $resource = DataCsResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make()
            ->label('New CS'),
        ];
    }

    public function getTitle(): string
    {
        return "Data CS";
    }
}
