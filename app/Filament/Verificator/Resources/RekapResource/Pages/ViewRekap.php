<?php

namespace App\Filament\Verificator\Resources\RekapResource\Pages;

use Filament\Resources\Pages\Page;
use App\Models\Form;
use App\Filament\Resources\RekapResource;

class ViewRekap extends Page
{
    protected static string $resource = RekapResource::class;

    protected static string $view = 'filament.resources.rekap-resource.pages.view-rekap-page';

    public Form $record;

    public function mount(Form $record)
    {
        $this->record = $record;
    }
}
