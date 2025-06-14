<?php

namespace App\Filament\Viewer\Resources;

use App\Filament\Viewer\Resources\DataCssResource\Pages;
use App\Models\DataCss;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class DataCssResource extends Resource
{
    protected static ?string $model = DataCss::class;

    protected static ?string $navigationIcon = 'heroicon-o-user-group';

    protected static ?string $navigationLabel = 'Data CSS';

    protected static ?string $navigationGroup = 'Data Pegawai';

    protected static ?int $navigationSort = 12;

    public static function getModelLabel(): string
    {
        return 'CSS';
    }

    public static function getPluralModelLabel(): string
    {
        return 'Data CSS';
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                //
                Tables\Columns\TextColumn::make('nama')
                ->label('Nama')
                ->searchable()
                ->sortable(),

                Tables\Columns\TextColumn::make('nik')
                ->label('NIK')
                ->searchable()
                ->sortable(),

                Tables\Columns\TextColumn::make('jabatan')
                ->label('Jabatan')
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
            'index' => Pages\ListDataCsses::route('/'),
        ];
    }
}
