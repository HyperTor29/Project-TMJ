<?php

namespace App\Filament\Resources;

use App\Filament\Resources\GerbangResource\Pages;
use App\Filament\Resources\GerbangResource\RelationManagers;
use App\Models\Gerbang;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

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
                Tables\Actions\DeleteBulkAction::make()
                    ->label('Delete'),
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
            'create' => Pages\CreateGerbang::route('/create'),
            'edit' => Pages\EditGerbang::route('/{record}/edit'),
        ];
    }
}
