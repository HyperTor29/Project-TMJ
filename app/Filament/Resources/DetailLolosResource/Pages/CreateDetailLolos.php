<?php

namespace App\Filament\Resources\DetailLolosResource\Pages;

use App\Filament\Resources\DetailLolosResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateDetailLolos extends CreateRecord
{
    protected static string $resource = DetailLolosResource::class;

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
