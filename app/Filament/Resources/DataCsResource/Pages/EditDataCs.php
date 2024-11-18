<?php

namespace App\Filament\Resources\DataCsResource\Pages;

use App\Filament\Resources\DataCsResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;
use Illuminate\Contracts\Support\Htmlable;

class EditDataCs extends EditRecord
{
    protected static string $resource = DataCsResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }

    public function getTitle(): string
    {
        return "Edit Data CS";
    }
}
