<?php

namespace App\Filament\Resources;

use App\Filament\Resources\GarduResource\Pages;
use App\Filament\Resources\GarduResource\RelationManagers;
use App\Models\Gardu;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class GarduResource extends Resource
{
    protected static ?string $model = Gardu::class;

    protected static ?string $navigationIcon = 'heroicon-o-folder';

    protected static ?string $navigationLabel = 'Daftar Gardu';

    protected static ?string $navigationGroup = 'Operasional';

    protected static ?int $navigationSort = 31;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                //
                Forms\Components\TextInput::make('gardu')
                ->label('Gardu')
                ->numeric()
                ->required(),

                Forms\Components\TextInput::make('jenis_gardu')
                ->label('Jenis Gardu')
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
                Tables\Columns\TextColumn::make('gardu')
                ->label('Gardu')
                ->searchable()
                ->sortable(),

                Tables\Columns\TextColumn::make('jenis_gardu')
                ->label('Jenis Gardu')
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
            'index' => Pages\ListGardus::route('/'),
            'create' => Pages\CreateGardu::route('/create'),
            'edit' => Pages\EditGardu::route('/{record}/edit'),
        ];
    }
}
