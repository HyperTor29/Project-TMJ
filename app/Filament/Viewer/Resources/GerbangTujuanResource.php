<?php

namespace App\Filament\Viewer\Resources;

use App\Filament\Viewer\Resources\GerbangTujuanResource\Pages;
use App\Filament\Viewer\Resources\GerbangTujuanResource\RelationManagers;
use App\Models\GerbangTujuan;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class GerbangTujuanResource extends Resource
{
    protected static ?string $model = GerbangTujuan::class;

    protected static ?string $navigationIcon = 'heroicon-o-folder';

    protected static ?string $navigationLabel = 'Daftar Gerbang Tujuan';

    protected static ?string $navigationGroup = 'Operasional';

    protected static ?int $navigationSort = 33;

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
            'index' => Pages\ListGerbangTujuans::route('/'),
        ];
    }
}
