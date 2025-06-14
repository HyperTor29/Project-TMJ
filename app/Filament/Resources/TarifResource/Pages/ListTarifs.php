<?php

namespace App\Filament\Resources\TarifResource\Pages;

use App\Filament\Resources\TarifResource;
use App\Models\Tarif;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;
use Illuminate\Contracts\View\View;

class ListTarifs extends ListRecords
{
    protected static string $resource = TarifResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make()
            ->label('New Tarif'),
        ];
    }

    public function getTitle(): string
    {
        return "Daftar Tarif";
    }

    // public function getHeader(): ?View
    // {
    //     $data = Actions\CreateAction::make();
    //     return view('filament.custom.upload-file', compact('data'));
    // }

    // public $file = '';

    // public function save() {
    //     $this->validate([
    //         'gerbang_id' => 'required|exists:gerbang,id',
    //         'gerbang_tujuan_id' => 'required|exists:gerbang_tujuan,id',
    //         'gol_kdr_id' => 'required|exists:golongan_kendaraan,id',
    //         'tarif' => 'required|numeric'
    //     ]);

    //     Tarif::create([
    //         'gerbang_id' => $this->gerbang_id,
    //         'gerbang_tujuan_id' => $this->gerbang_tujuan_id,
    //         'gol_kdr_id' => $this->gol_kdr_id,
    //         'tarif' => $this->tarif
    //     ]);
    // }
}
