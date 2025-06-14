<?php

namespace App\Filament\Validator\Resources\FormResource\Pages;

use App\Filament\Validator\Resources\FormResource;
use Filament\Actions\Action;
use Filament\Resources\Pages\EditRecord;

class EditForm extends EditRecord
{
    protected static string $resource = FormResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Action::make('back')
                ->label('Kembali')
                ->url($this->previousUrl ?? static::getResource()::getUrl())
                ->color('primary')
                ->icon('heroicon-m-arrow-left'),
        ];
    }

    public function getTitle(): string
    {
        return "Progress Form";
    }

    protected function getFormActions(): array
    {
        return [
        ];
    }
}
