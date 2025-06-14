<?php

namespace App\Filament\Resources\GolKdrResource\Pages;

use App\Filament\Resources\GolKdrResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateGolKdr extends CreateRecord
{
    protected static string $resource = GolKdrResource::class;

    public function getTitle(): string
    {
        return "Create Golongan Kendaraan";
    }

    protected function getFormActions(): array
    {
        return [
            $this->getCreateFormAction()
                ->label('Save'),
            $this->getCreateAnotherFormAction()
                ->label('Save & Create Another'),
            $this->getCancelFormAction()
                ->label('Cancel'),
        ];
    }
}
