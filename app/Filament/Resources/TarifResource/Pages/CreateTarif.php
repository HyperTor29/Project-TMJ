<?php

namespace App\Filament\Resources\TarifResource\Pages;

use App\Filament\Resources\TarifResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateTarif extends CreateRecord
{
    protected static string $resource = TarifResource::class;

    public function getTitle(): string
    {
        return "Create Daftar Tarif";
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
