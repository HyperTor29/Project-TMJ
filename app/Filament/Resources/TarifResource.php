<?php

namespace App\Filament\Resources;

use App\Filament\Resources\TarifResource\Pages;
use App\Filament\Resources\TarifResource\RelationManagers;
use App\Models\Tarif;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class TarifResource extends Resource
{
    protected static ?string $model = Tarif::class;

    protected static ?string $navigationIcon = 'heroicon-o-folder';

    protected static ?string $navigationLabel = 'Daftar Tarif';

    protected static ?string $navigationGroup = 'Operasional';

    protected static ?int $navigationSort = 37;

    public static function getModelLabel(): string
    {
        return 'Tarif';
    }

    public static function getPluralModelLabel(): string
    {
        return 'Daftar Tarif';
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                //
                Forms\Components\Select::make('gerbang_id')
                ->label('Gerbang Asal')
                ->relationship('Gerbang', 'name')
                ->required(),

                Forms\Components\Select::make('gerbang_tujuan_id')
                ->label('Gerbang Tujuan')
                ->relationship('GerbangTujuan', 'name')
                ->required(),

                Forms\Components\Select::make('gol_kdr_id')
                ->label('Golongan Kendaraan')
                ->relationship('GolKdr', 'golongan')
                ->required(),

                Forms\Components\TextInput::make('tarif')
                ->label('Tarif')
                ->numeric()
                ->prefix('IDR')
                ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                //
                Tables\Columns\TextColumn::make('Gerbang.name')
                ->label('Gerbang Asal')
                ->searchable()
                ->sortable(),

                Tables\Columns\TextColumn::make('GerbangTujuan.name')
                ->label('Gerbang Tujuan')
                ->searchable()
                ->sortable(),

                Tables\Columns\TextColumn::make('GolKdr.golongan')
                ->label('Golongan Kendaraan')
                ->searchable()
                ->sortable(),

                Tables\Columns\TextColumn::make('tarif')
                ->label('Tarif')
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
            'index' => Pages\ListTarifs::route('/'),
            'create' => Pages\CreateTarif::route('/create'),
            'edit' => Pages\EditTarif::route('/{record}/edit'),
        ];
    }
}
