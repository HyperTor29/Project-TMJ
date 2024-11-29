<?php

namespace App\Filament\Resources;

use App\Filament\Resources\FormResource\Pages;
use App\Filament\Resources\FormResource\RelationManagers;
use App\Models\Form;
use Filament\Forms;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;

class FormResource extends Resource
{
    protected static ?string $model = Form::class;

    protected static ?string $navigationIcon = 'heroicon-o-document-plus';

    protected static ?string $navigationLabel = 'Form Isian';

    protected static ?string $navigationGroup = 'Laporan';

    protected static ?int $navigationSort = 21;

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()->where('user_id', Auth::id());
    }

    public static function form(Forms\Form $form): Forms\Form
    {
        return $form
            ->schema([
                //
                Forms\Components\Datepicker::make('tanggal')
                ->label('Tanggal')
                ->required(),

                Forms\Components\Select::make('shifts_id')
                ->label('Shift')
                ->relationship('Shifts', 'shift')
                ->required(),

                Forms\Components\Select::make('data_cs_id')
                ->label('Nama CS')
                ->relationship('DataCs', 'nama')
                ->required(),

                Forms\Components\Select::make('data_cs_id')
                ->label('NIK CS')
                ->relationship('DataCs', 'nik')
                ->required(),

                Forms\Components\Select::make('data_cs_id')
                ->label('Jabatan CS')
                ->relationship('DataCs', 'jabatan')
                ->required(),

                Forms\Components\Select::make('data_css_id')
                ->label('Nama CSS')
                ->relationship('DataCss', 'nama')
                ->required(),

                Forms\Components\Select::make('data_css_id')
                ->label('NIK CSS')
                ->relationship('DataCss', 'nik')
                ->required(),

                Forms\Components\Select::make('data_css_id')
                ->label('Jabatan CSS')
                ->relationship('DataCss', 'jabatan')
                ->required(),

                Forms\Components\Select::make('asmen_id')
                ->label('Nama Asmen')
                ->relationship('Asmen', 'nama')
                ->required(),

                Forms\Components\Select::make('asmen_id')
                ->label('NIK Asmen')
                ->relationship('Asmen', 'nik')
                ->required(),

                Forms\Components\Select::make('asmen_id')
                ->label('Jabatan Asmen')
                ->relationship('Asmen', 'jabatan')
                ->required()
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                //
                Tables\Columns\TextColumn::make('tanggal')
                ->label('Tanggal')
                ->searchable()
                ->sortable(),

                Tables\Columns\TextColumn::make('Shifts.shift')
                ->label('Shift')
                ->searchable()
                ->sortable(),

                Tables\Columns\TextColumn::make('DataCs.nama')
                ->label('Nama CS')
                ->searchable()
                ->sortable(),

                Tables\Columns\TextColumn::make('DataCs.nik')
                ->label('NIK CS')
                ->searchable()
                ->sortable(),

                Tables\Columns\TextColumn::make('DataCs.jabatan')
                ->label('Jabatan CS')
                ->searchable()
                ->sortable(),

                Tables\Columns\TextColumn::make('DataCss.nama')
                ->label('Nama CSS')
                ->searchable()
                ->sortable(),

                Tables\Columns\TextColumn::make('DataCss.nik')
                ->label('NIK CSS')
                ->searchable()
                ->sortable(),

                Tables\Columns\TextColumn::make('DataCss.jabatan')
                ->label('Jabatan CSS')
                ->searchable()
                ->sortable(),

                Tables\Columns\TextColumn::make('Asmen.nama')
                ->label('Nama Asmen')
                ->searchable()
                ->sortable(),

                Tables\Columns\TextColumn::make('Asmen.nik')
                ->label('NIK Asmen')
                ->searchable()
                ->sortable(),

                Tables\Columns\TextColumn::make('Asmen.jabatan')
                ->label('Jabatan Asmen')
                ->searchable()
                ->sortable()
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
            RelationManagers\DetailLolosRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListForms::route('/'),
            'create' => Pages\CreateForm::route('/create'),
            'edit' => Pages\EditForm::route('/{record}/edit'),
        ];
    }
}
