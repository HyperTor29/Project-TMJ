<?php

namespace App\Filament\Resources\DataSecurityResource\Pages;

use App\Filament\Resources\DataSecurityResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateDataSecurity extends CreateRecord
{
    protected static string $resource = DataSecurityResource::class;

    public function getTitle(): string
    {
        return "Create Data Security";
    }
}
