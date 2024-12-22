<?php

namespace App\Filament\Viewer\Resources;

use App\Filament\Viewer\Resources\ShiftResource\Pages;
use App\Models\Shift;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class ShiftResource extends Resource
{
    protected static ?string $model = Shift::class;

    protected static ?string $navigationIcon = 'heroicon-o-folder';

    protected static ?string $navigationLabel = 'Daftar Shift';

    protected static ?string $navigationGroup = 'Operasional';

    protected static ?int $navigationSort = 36;

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                //
                Tables\Columns\TextColumn::make('shift')
                ->label('Shift')
                ->searchable()
                ->sortable(),

                Tables\Columns\TextColumn::make('jam_masuk')
                ->label('Jam Masuk')
                ->searchable()
                ->sortable(),

                Tables\Columns\TextColumn::make('jam_keluar')
                ->label('Jam Keluar')
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
            'index' => Pages\ListShifts::route('/'),
        ];
    }
}
