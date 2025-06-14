<?php

namespace App\Filament\Resources\GarduResource\Pages;

use App\Filament\Resources\GarduResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateGardu extends CreateRecord
{
    protected static string $resource = GarduResource::class;

    public function getTitle(): string
    {
        return "Create Daftar Gardu";
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
