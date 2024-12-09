<?php

namespace App\Filament\Viewer\Resources\InstansiResource\Pages;

use App\Filament\Viewer\Resources\InstansiResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditInstansi extends EditRecord
{
    protected static string $resource = InstansiResource::class;

    protected function getHeaderActions(): array
    {
        return [
            // Actions\DeleteAction::make(),
        ];
    }
}
