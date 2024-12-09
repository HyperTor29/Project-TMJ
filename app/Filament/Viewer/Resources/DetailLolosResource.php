<?php

namespace App\Filament\Viewer\Resources;

use App\Filament\Viewer\Resources\DetailLolosResource\Pages;
use App\Filament\Viewer\Resources\DetailLolosResource\RelationManagers;
use App\Models\DetailLolos;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Tables\Columns\ImageColumn;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Facades\Auth;

class DetailLolosResource extends Resource
{
    protected static ?string $model = DetailLolos::class;

    protected static ?string $navigationIcon = 'heroicon-o-arrow-down-on-square-stack';

    protected static ?string $navigationGroup = 'Laporan';

    protected static ?int $navigationSort = 22;

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()->where('user_id', Auth::id());
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                //
                Tables\Columns\TextColumn::make('id')
                ->label('Id')
                ->searchable()
                ->sortable(),

                Tables\Columns\TextColumn::make('pukul')
                ->label('Pukul')
                ->searchable()
                ->sortable(),

                Tables\Columns\TextColumn::make('Gardu.gardu')
                ->label('Gardu')
                ->searchable()
                ->sortable(),

                Tables\Columns\TextColumn::make('nomor_resi_awal')
                ->label('Nomor Resi Awal')
                ->searchable()
                ->sortable(),

                Tables\Columns\TextColumn::make('nomor_resi_akhir')
                ->label('Nomor Resi Akhir')
                ->searchable()
                ->sortable(),

                Tables\Columns\TextColumn::make('Gerbang.name')
                ->label('Gerbang')
                ->searchable()
                ->sortable(),

                Tables\Columns\TextColumn::make('jumlah_kdr')
                ->label('Jumlah Kendaraan')
                ->searchable()
                ->sortable(),

                Tables\Columns\TextColumn::make('GolKdr.golongan')
                ->label('Golongan Kendaraan')
                ->searchable()
                ->sortable(),

                Tables\Columns\TextColumn::make('nomor_kendaraan')
                ->label('Nomor Kendaraan')
                ->searchable()
                ->sortable(),

                Tables\Columns\TextColumn::make('Instansi.instansi')
                ->label('Instansi')
                ->searchable()
                ->sortable(),

                Tables\Columns\TextColumn::make('penanggung_jawab')
                ->label('Penanggung Jawab')
                ->searchable()
                ->sortable(),

                Tables\Columns\CheckboxColumn::make('surat_izin_lintas')
                ->label('Surat Izin Lintas')
                ->searchable(),

                Tables\Columns\ImageColumn::make('surats.surat')
                ->label('Foto Surat')
                ->url(fn ($record) => asset('storage/' . $record->surat)),

                Tables\Columns\ImageColumn::make('fotos.foto')
                ->label('Foto Kendaraan')
                ->url(fn ($record) => asset('storage/' . $record->foto)),

                Tables\Columns\TextColumn::make('status')
                ->label('Status')
                ->searchable()
            ])
            ->filters([
                //
            ])
            ->actions([
                //
            ])
            ->bulkActions([
                //
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListDetailLolos::route('/'),
        ];
    }
}
