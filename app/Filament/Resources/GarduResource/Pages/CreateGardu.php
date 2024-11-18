<?php

namespace App\Filament\Resources\GarduResource\Pages;

use App\Filament\Resources\GarduResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateGardu extends CreateRecord
{
    protected static string $resource = GarduResource::class;

    public function getTitle(): string
    {
        return "Create Daftar Gardu";
    }
}
