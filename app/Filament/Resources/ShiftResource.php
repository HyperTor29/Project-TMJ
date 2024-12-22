<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ShiftResource\Pages;
use App\Filament\Resources\ShiftResource\RelationManagers;
use App\Models\Shift;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ShiftResource extends Resource
{
    protected static ?string $model = Shift::class;

    protected static ?string $navigationIcon = 'heroicon-o-folder';

    protected static ?string $navigationLabel = 'Daftar Shift';

    protected static ?string $navigationGroup = 'Operasional';

    protected static ?int $navigationSort = 36;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                //
                Forms\Components\TextInput::make('shift')
                ->label('Shift')
                ->minLength(1)
                ->maxLength(1)
                ->required(),

                Forms\Components\TextInput::make('jam_masuk')
                ->label('Jam Masuk')
                ->minLength(2)
                ->maxLength(16)
                ->required(),

                Forms\Components\TextInput::make('jam_keluar')
                ->label('Jam Keluar')
                ->minLength(2)
                ->maxLength(16)
                ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                //
                Tables\Columns\TextColumn::make('shift')
                ->label('Shift')
                ->searchable()
                ->sortable(),

                Tables\Columns\TextColumn::make('jam_masuk')
                ->label('Jam Masuk')
                ->searchable()
                ->sortable(),

                Tables\Columns\TextColumn::make('jam_keluar')
                ->label('Jam Keluar')
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
            'index' => Pages\ListShifts::route('/'),
            'create' => Pages\CreateShift::route('/create'),
            'edit' => Pages\EditShift::route('/{record}/edit'),
        ];
    }
}
