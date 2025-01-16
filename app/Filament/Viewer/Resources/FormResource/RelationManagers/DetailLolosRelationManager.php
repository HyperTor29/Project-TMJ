<?php

namespace App\Filament\Viewer\Resources\FormResource\RelationManagers;

use Filament\Tables;
use Illuminate\Database\Eloquent\Builder;
use Filament\Resources\RelationManagers\RelationManager;
use Illuminate\Support\Facades\Auth;

class DetailLolosRelationManager extends RelationManager
{
    protected static string $relationship = 'detailLolos';

    protected static ?string $recordTitleAttribute = 'id';

    public static function getEloquentQuery(): Builder
    {
        $query = parent::getEloquentQuery();

        if (in_array(Auth::user()->role->name, ['Admin', 'Validator', 'Viewer'])) {
            return $query;
        }

        return $query->where(function ($query) {
            $query->where('user_id', Auth::id())
                ->orWhereHas('dataCs', function ($query) {
                    $query->where('user_id', Auth::id())
                        ->orWhere('nama', Auth::user()->name);
                })
                ->orWhereHas('dataCss', function ($query) {
                    $query->where('user_id', Auth::id())
                        ->orWhere('nama', Auth::user()->name);
                })
                ->orWhereHas('asmen', function ($query) {
                    $query->where('user_id', Auth::id())
                        ->orWhere('nama', Auth::user()->name);
                });
        });
    }

    public function table(Tables\Table $table): Tables\Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('pukul')
                    ->label('Pukul')
                    ->sortable()
                    ->searchable()
                    ->formatStateUsing(fn ($state) => \Carbon\Carbon::parse($state)->setTimezone('Asia/Jakarta')->format('H:i')),

                Tables\Columns\TextColumn::make('Gardu.gardu')
                    ->label('Gardu')
                    ->sortable()
                    ->searchable(),

                Tables\Columns\TextColumn::make('nomor_resi_awal')
                    ->label('Nomor Resi Awal')
                    ->sortable()
                    ->searchable(),

                Tables\Columns\TextColumn::make('nomor_resi_akhir')
                    ->label('Nomor Resi Akhir')
                    ->sortable()
                    ->searchable(),

                Tables\Columns\TextColumn::make('Gerbang.name')
                    ->label('Gerbang Asal')
                    ->sortable()
                    ->searchable(),

                Tables\Columns\TextColumn::make('jumlah_kdr')
                    ->label('Jumlah Kendaraan')
                    ->sortable()
                    ->searchable(),

                Tables\Columns\TextColumn::make('GolKdr.golongan')
                    ->label('Golongan Kendaraan')
                    ->sortable()
                    ->searchable(),

                Tables\Columns\TextColumn::make('nomor_kendaraan')
                    ->label('Nomor Kendaraan')
                    ->sortable(),

                Tables\Columns\TextColumn::make('Instansi.instansi')
                    ->label('Instansi')
                    ->sortable()
                    ->searchable(),

                Tables\Columns\TextColumn::make('penanggung_jawab')
                    ->label('Penanggung Jawab')
                    ->sortable()
                    ->searchable(),

                Tables\Columns\CheckboxColumn::make('surat_izin_lintas')
                    ->label('Surat Izin Lintas'),

                Tables\Columns\ImageColumn::make('surats.surat')
                    ->label('Foto Surat')
                    ->url(fn ($record) => asset('storage/' . $record->surat)),

                Tables\Columns\ImageColumn::make('fotos.foto')
                    ->label('Foto Kendaraan')
                    ->url(fn ($record) => asset('storage/' . $record->foto)),

                Tables\Columns\TextColumn::make('status')
                    ->label('Status')
            ])
            ->filters([])
            ->headerActions([
                //
            ])
            ->actions([
                //
            ])
            ->bulkActions([
                //
            ]);
    }
}
