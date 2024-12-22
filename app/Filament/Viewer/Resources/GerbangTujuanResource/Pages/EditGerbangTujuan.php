<?php

namespace App\Filament\Viewer\Resources\GerbangTujuanResource\Pages;

use App\Filament\Viewer\Resources\GerbangTujuanResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditGerbangTujuan extends EditRecord
{
    protected static string $resource = GerbangTujuanResource::class;

    protected function getHeaderActions(): array
    {
        return [
            // Actions\DeleteAction::make(),
        ];
    }
}
