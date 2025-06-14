<?php

namespace App\Filament\Resources\AsmenResource\Pages;

use App\Filament\Resources\AsmenResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateAsmen extends CreateRecord
{
    protected static string $resource = AsmenResource::class;

    public function getTitle(): string
    {
        return "Create Data Asmen";
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

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
