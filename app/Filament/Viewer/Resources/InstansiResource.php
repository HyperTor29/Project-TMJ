<?php

namespace App\Filament\Viewer\Resources;

use App\Filament\Viewer\Resources\InstansiResource\Pages;
use App\Models\Instansi;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class InstansiResource extends Resource
{
    protected static ?string $model = Instansi::class;

    protected static ?string $navigationIcon = 'heroicon-o-folder';

    protected static ?string $navigationLabel = 'Daftar Instansi';

    protected static ?string $navigationGroup = 'Operasional';

    protected static ?int $navigationSort = 35;

    public static function getModelLabel(): string
    {
        return 'Instansi';
    }

    public static function getPluralModelLabel(): string
    {
        return 'Daftar Instansi';
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                //
                Tables\Columns\TextColumn::make('instansi')
                ->label('Instansi')
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
            'index' => Pages\ListInstansis::route('/'),
        ];
    }
}
