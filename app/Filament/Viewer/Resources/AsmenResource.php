<?php

namespace App\Filament\Viewer\Resources;

use App\Filament\Viewer\Resources\AsmenResource\Pages;
use App\Models\Asmen;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class AsmenResource extends Resource
{
    protected static ?string $model = Asmen::class;

    protected static ?string $navigationIcon = 'heroicon-o-user-group';

    protected static ?string $navigationLabel = 'Data Asmen';

    protected static ?string $navigationGroup = 'Data Pegawai';

    protected static ?int $navigationSort = 13;

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
            'index' => Pages\ListAsmens::route('/'),
        ];
    }
}
