<?php

namespace App\Filament\Resources\DataSecurityResource\Pages;

use App\Filament\Resources\DataSecurityResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditDataSecurity extends EditRecord
{
    protected static string $resource = DataSecurityResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }

    public function getTitle(): string
    {
        return "Edit Data Security";
    }
}
