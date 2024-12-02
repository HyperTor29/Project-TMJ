<?php

namespace App\Filament\User\Resources\DetailLolosResource\Pages;

use App\Filament\User\Resources\DetailLolosResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditDetailLolos extends EditRecord
{
    protected static string $resource = DetailLolosResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
