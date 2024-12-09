<?php

namespace App\Filament\Viewer\Resources;

use App\Filament\Viewer\Resources\GarduResource\Pages;
use App\Models\Gardu;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class GarduResource extends Resource
{
    protected static ?string $model = Gardu::class;

    protected static ?string $navigationIcon = 'heroicon-o-folder';

    protected static ?string $navigationLabel = 'Daftar Gardu';

    protected static ?string $navigationGroup = 'Operasional';

    protected static ?int $navigationSort = 31;

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                //
                Tables\Columns\TextColumn::make('gardu')
                ->label('Gardu')
                ->searchable()
                ->sortable(),

                Tables\Columns\TextColumn::make('jenis_gardu')
                ->label('Jenis Gardu')
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
            'index' => Pages\ListGardus::route('/'),
        ];
    }
}
