<?php

namespace App\Filament\Viewer\Resources;

use App\Filament\Resources\DataCsResource\Pages;
use App\Filament\Resources\DataCsResource\RelationManagers;
use App\Models\DataCs;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class DataCsResource extends Resource
{
    protected static ?string $model = DataCs::class;

    protected static ?string $navigationIcon = 'heroicon-o-user-group';

    protected static ?string $navigationLabel = 'Data CS';

    protected static ?string $navigationGroup = 'Data Pegawai';

    protected static ?int $navigationSort = 11;

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
                // Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                // Tables\Actions\BulkActionGroup::make([
                //     Tables\Actions\DeleteBulkAction::make(),
                // ]),
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
