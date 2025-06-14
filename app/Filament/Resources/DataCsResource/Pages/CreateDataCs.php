<?php

namespace App\Filament\Resources\DataCsResource\Pages;

use App\Filament\Resources\DataCsResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateDataCs extends CreateRecord
{
    protected static string $resource = DataCsResource::class;

    public function getTitle(): string
    {
        return "Create Data CS";
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
