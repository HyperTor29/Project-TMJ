<?php

namespace App\Filament\Resources\DataCsResource\Pages;

use App\Filament\Resources\DataCsResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateDataCs extends CreateRecord
{
    protected static string $resource = DataCsResource::class;

    public function getTitle(): string
    {
        return "Create Data CS";
    }
}
