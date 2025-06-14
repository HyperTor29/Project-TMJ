<?php

namespace App\Filament\Resources;

use App\Filament\Resources\AsmenResource\Pages;
use App\Models\Asmen;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use App\Filament\Widgets\CustomStatsOverview;

class AsmenResource extends Resource
{
    protected static ?string $model = Asmen::class;

    protected static ?string $navigationIcon = 'heroicon-o-user-group';

    protected static ?string $navigationLabel = 'Data Asmen';

    protected static ?string $navigationGroup = 'Data Pegawai';

    protected static ?int $navigationSort = 13;

    public static function getModelLabel(): string
    {
        return 'Asmen';
    }

    public static function getPluralModelLabel(): string
    {
        return 'Data Asmen';
    }

    protected static function getHeaderWidgets(): array
    {
        return [
            CustomStatsOverview::class,
        ];
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                //
                Forms\Components\TextInput::make('nama')
                ->label('Nama')
                ->minLength(2)
                ->maxLength(255)
                ->required(),

                Forms\Components\TextInput::make('nik')
                ->label('NIK')
                ->numeric()
                ->minLength(2)
                ->maxLength(16)
                ->required(),

                Forms\Components\TextInput::make('jabatan')
                ->label('Jabatan')
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
            'index' => Pages\ListAsmens::route('/'),
            'create' => Pages\CreateAsmen::route('/create'),
            'edit' => Pages\EditAsmen::route('/{record}/edit'),
        ];
    }
}
