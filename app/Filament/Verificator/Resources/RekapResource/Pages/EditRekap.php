<?php

namespace App\Filament\Verificator\Resources\RekapResource\Pages;

use App\Filament\Verificator\Resources\RekapResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditRekap extends EditRecord
{
    protected static string $resource = RekapResource::class;

    protected function getHeaderActions(): array
    {
        return [
            // Actions\DeleteAction::make(),
        ];
    }
}
