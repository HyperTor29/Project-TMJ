<?php

namespace App\Filament\Resources\GolKdrResource\Pages;

use App\Filament\Resources\GolKdrResource;
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

    public function getTitle(): string
    {
        return "Edit Golongan Kendaraan";
    }
}
