<?php

namespace App\Filament\Resources\DataCssResource\Pages;

use App\Filament\Resources\DataCssResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateDataCss extends CreateRecord
{
    protected static string $resource = DataCssResource::class;

    public function getTitle(): string
    {
        return "Create Data CSS";
    }
}
