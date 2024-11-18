<?php

namespace App\Filament\Resources\AsmenResource\Pages;

use App\Filament\Resources\AsmenResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateAsmen extends CreateRecord
{
    protected static string $resource = AsmenResource::class;

    public function getTitle(): string
    {
        return "Create Data Asmen";
    }
}
