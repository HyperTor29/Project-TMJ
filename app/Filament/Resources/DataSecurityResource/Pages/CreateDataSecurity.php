<?php

namespace App\Filament\Resources\DataSecurityResource\Pages;

use App\Filament\Resources\DataSecurityResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateDataSecurity extends CreateRecord
{
    protected static string $resource = DataSecurityResource::class;

    public function getTitle(): string
    {
        return "Create Data Security";
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
