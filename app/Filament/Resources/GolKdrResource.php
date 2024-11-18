<?php

namespace App\Filament\Resources;

use App\Filament\Resources\GolKdrResource\Pages;
use App\Filament\Resources\GolKdrResource\RelationManagers;
use App\Models\GolKdr;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class GolKdrResource extends Resource
{
    protected static ?string $model = GolKdr::class;

    protected static ?string $navigationIcon = 'heroicon-o-folder';

    protected static ?string $navigationLabel = 'Golongan Kendaraan';

    protected static ?string $navigationGroup = 'Operasional';

    protected static ?int $navigationSort = 33;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                //
                Forms\Components\TextInput::make('golongan')
                ->label('Golongan')
                ->numeric()
                ->minLength(1)
                ->maxLength(5)
                ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                //
                Tables\Columns\TextColumn::make('golongan')
                ->label('Golongan')
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
            'index' => Pages\ListGolKdrs::route('/'),
            'create' => Pages\CreateGolKdr::route('/create'),
            'edit' => Pages\EditGolKdr::route('/{record}/edit'),
        ];
    }
}
