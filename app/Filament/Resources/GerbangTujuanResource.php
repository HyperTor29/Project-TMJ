<?php

namespace App\Filament\Resources;

use App\Filament\Resources\GerbangTujuanResource\Pages;
use App\Filament\Resources\GerbangTujuanResource\RelationManagers;
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

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                //
                Forms\Components\TextInput::make('kode')
                ->label('Kode')
                ->numeric()
                ->required(),

                Forms\Components\TextInput::make('name')
                ->label('Nama')
                ->minLength(2)
                ->maxLength(255)
                ->required(),
            ]);
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
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
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
            'create' => Pages\CreateGerbangTujuan::route('/create'),
            'edit' => Pages\EditGerbangTujuan::route('/{record}/edit'),
        ];
    }
}
