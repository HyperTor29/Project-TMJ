<?php

namespace App\Filament\Viewer\Resources\AsmenResource\Pages;

use App\Filament\Viewer\Resources\AsmenResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditAsmen extends EditRecord
{
    protected static string $resource = AsmenResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
