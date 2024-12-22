<?php

namespace App\Filament\Viewer\Resources;

use App\Filament\Viewer\Resources\TarifResource\Pages;
use App\Models\Tarif;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class TarifResource extends Resource
{
    protected static ?string $model = Tarif::class;

    protected static ?string $navigationIcon = 'heroicon-o-folder';

    protected static ?string $navigationLabel = 'Daftar Tarif';

    protected static ?string $navigationGroup = 'Operasional';

    protected static ?int $navigationSort = 37;

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                //
                Tables\Columns\TextColumn::make('Gerbang.name')
                ->label('Gerbang')
                ->searchable()
                ->sortable(),

                Tables\Columns\TextColumn::make('GolKdr.golongan')
                ->label('Golongan Kendaraan')
                ->searchable()
                ->sortable(),

                Tables\Columns\TextColumn::make('tarif')
                ->label('Tarif')
                ->searchable()
                ->sortable(),
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
            'index' => Pages\ListTarifs::route('/'),
        ];
    }
}
