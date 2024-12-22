<?php

namespace App\Filament\Resources\GerbangTujuanResource\Pages;

use App\Filament\Resources\GerbangTujuanResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateGerbangTujuan extends CreateRecord
{
    protected static string $resource = GerbangTujuanResource::class;

    public function getTitle(): string
    {
        return "Create Daftar Gerbang Tujuan";
    }
}
