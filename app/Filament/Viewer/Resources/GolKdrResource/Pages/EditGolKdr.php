<?php

namespace App\Filament\Viewer\Resources\GolKdrResource\Pages;

use App\Filament\Viewer\Resources\GolKdrResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditGolKdr extends EditRecord
{
    protected static string $resource = GolKdrResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
