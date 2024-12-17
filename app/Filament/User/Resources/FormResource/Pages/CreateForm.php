<?php

namespace App\Filament\User\Resources\FormResource\Pages;

use App\Filament\User\Resources\FormResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateForm extends CreateRecord
{
    protected static string $resource = FormResource::class;

    public function getTitle(): string
    {
        return "Create Form Isian";
    }

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $data['user_id'] = \Illuminate\Support\Facades\Auth::id();
        return $data;
    }
}
