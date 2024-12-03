<?php

namespace App\Filament\Viewer\Resources\DataCssResource\Pages;

use App\Filament\Viewer\Resources\DataCssResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditDataCss extends EditRecord
{
    protected static string $resource = DataCssResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
