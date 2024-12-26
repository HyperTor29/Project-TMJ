<?php

namespace App\Filament\Viewer\Resources;

use App\Filament\Viewer\Resources\DataSecurityResource\Pages;
use App\Filament\Viewer\Resources\DataSecurityResource\RelationManagers;
use App\Models\DataSecurity;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class DataSecurityResource extends Resource
{
    protected static ?string $model = DataSecurity::class;

    protected static ?string $navigationIcon = 'heroicon-o-user-group';

    protected static ?string $navigationLabel = 'Data Security';

    protected static ?string $navigationGroup = 'Data Pegawai';

    protected static ?int $navigationSort = 14;

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
            'index' => Pages\ListDataSecurities::route('/'),
        ];
    }
}
