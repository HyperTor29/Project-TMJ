<?php

namespace App\Filament\Resources\DataCssResource\Pages;

use App\Filament\Resources\DataCssResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateDataCss extends CreateRecord
{
    protected static string $resource = DataCssResource::class;

    public function getTitle(): string
    {
        return "Create Data CSS";
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
