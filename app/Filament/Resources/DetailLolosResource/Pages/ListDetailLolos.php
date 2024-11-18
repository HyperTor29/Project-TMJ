<?php

namespace App\Filament\Resources\DetailLolosResource\Pages;

use App\Filament\Resources\DetailLolosResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;
use Filament\Tables\Columns\ImageColumn;

class ListDetailLolos extends ListRecords
{
    protected static string $resource = DetailLolosResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }

    protected function getTableColumns(): array
    {
        return [
            ImageColumn::make('surat')
            ->label('Surat')
            ->size(50, 50),

            ImageColumn::make('foto')
            ->label('Foto')
            ->size(50, 50),
        ];
    }
}
