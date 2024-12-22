<?php

namespace App\Filament\Viewer\Resources;

use App\Filament\Viewer\Resources\GolKdrResource\Pages;
use App\Models\GolKdr;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class GolKdrResource extends Resource
{
    protected static ?string $model = GolKdr::class;

    protected static ?string $navigationIcon = 'heroicon-o-folder';

    protected static ?string $navigationLabel = 'Golongan Kendaraan';

    protected static ?string $navigationGroup = 'Operasional';

    protected static ?int $navigationSort = 34;

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                //
                Tables\Columns\TextColumn::make('golongan')
                ->label('Golongan')
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
            'index' => Pages\ListGolKdrs::route('/'),
        ];
    }
}
