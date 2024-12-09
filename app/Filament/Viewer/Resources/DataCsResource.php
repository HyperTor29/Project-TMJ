<?php

namespace App\Filament\Viewer\Resources;

use App\Filament\Viewer\Resources\DataCsResource\Pages;
use App\Models\DataCs;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class DataCsResource extends Resource
{
    protected static ?string $model = DataCs::class;

    protected static ?string $navigationIcon = 'heroicon-o-user-group';

    protected static ?string $navigationLabel = 'Data CS';

    protected static ?string $navigationGroup = 'Data Pegawai';

    protected static ?int $navigationSort = 11;

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
            'index' => Pages\ListDataCs::route('/'),
        ];
    }
}
