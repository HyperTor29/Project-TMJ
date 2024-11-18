<?php

namespace App\Filament\Resources\DataCssResource\Pages;

use App\Filament\Resources\DataCssResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditDataCss extends EditRecord
{
    protected static string $resource = DataCssResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make()
        ];
    }

    public function getTitle(): string
    {
        return "Edit Data CSS";
    }
}
