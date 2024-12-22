<?php

namespace App\Filament\Resources\GerbangTujuanResource\Pages;

use App\Filament\Resources\GerbangTujuanResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditGerbangTujuan extends EditRecord
{
    protected static string $resource = GerbangTujuanResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }

    public function getTitle(): string
    {
        return "Edit Daftar Gerbang Tujuan";
    }
}
