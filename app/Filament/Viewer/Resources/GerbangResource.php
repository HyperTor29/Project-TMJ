<?php

namespace App\Filament\Viewer\Resources;

use App\Filament\Viewer\Resources\GerbangResource\Pages;
use App\Models\Gerbang;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;


class GerbangResource extends Resource
{
    protected static ?string $model = Gerbang::class;

    protected static ?string $navigationIcon = 'heroicon-o-folder';

    protected static ?string $navigationLabel = 'Daftar Gerbang Asal';

    protected static ?string $navigationGroup = 'Operasional';

    protected static ?int $navigationSort = 32;

    public static function getModelLabel(): string
    {
        return 'Gerbang';
    }

    public static function getPluralModelLabel(): string
    {
        return 'Daftar Gerbang Asal';
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                //
                Tables\Columns\TextColumn::make('kode')
                ->label('Kode')
                ->searchable()
                ->sortable(),

                Tables\Columns\TextColumn::make('name')
                ->label('Nama')
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
            'index' => Pages\ListGerbangs::route('/'),
        ];
    }
}
