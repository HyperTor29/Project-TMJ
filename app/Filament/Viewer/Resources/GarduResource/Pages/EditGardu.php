<?php

namespace App\Filament\Viewer\Resources\GarduResource\Pages;

use App\Filament\Viewer\Resources\GarduResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditGardu extends EditRecord
{
    protected static string $resource = GarduResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
