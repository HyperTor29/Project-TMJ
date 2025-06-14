<?php

namespace App\Filament\Validator\Resources;

use App\Filament\Validator\Resources\FormResource\Pages;
use App\Filament\Validator\Resources\FormResource\RelationManagers;
use App\Models\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Builder;

class FormResource extends Resource
{
    protected static ?string $model = Form::class;

    protected static ?string $navigationIcon = 'heroicon-o-document-plus';

    protected static ?string $navigationLabel = 'Form Isian';

    protected static ?string $navigationGroup = 'Laporan';

    public static function getModelLabel(): string
    {
        return 'Form Isian';
    }

    public static function getPluralModelLabel(): string
    {
        return 'Form Isian';
    }

    public static function getEloquentQuery(): Builder
    {
        $query = parent::getEloquentQuery()->orderBy('tanggal', 'desc');

        if (in_array(Auth::user()->role->name, ['Admin', 'Validator', 'Viewer'])) {
            return $query;
        }

        return $query->where(function ($query) {
            $query->where('user_id', Auth::id())
                ->orWhereHas('dataCs', function ($query) {
                    $query->where('user_id', Auth::id())
                        ->orWhere('nama', Auth::user()->name);
                })
                ->orWhereHas('dataCss', function ($query) {
                    $query->where('user_id', Auth::id())
                        ->orWhere('nama', Auth::user()->name);
                })
                ->orWhereHas('asmen', function ($query) {
                    $query->where('user_id', Auth::id())
                        ->orWhere('nama', Auth::user()->name);
                })
                ->orWhereHas('dataSecurity', function ($query) {
                    $query->where('user_id', Auth::id())
                        ->orWhere('nama', Auth::user()->name);
                });
        });
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                //
                Tables\Columns\TextColumn::make('tanggal')
                    ->label('Tanggal')
                    ->date('d/m/Y')
                    ->searchable()
                    ->sortable(),

                Tables\Columns\TextColumn::make('GerbangTujuan.name')
                    ->label('Gerbang Tol')
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
                    ->sortable(),

                Tables\Columns\TextColumn::make('DataSecurity.nama')
                    ->label('Nama Security')
                    ->searchable()
                    ->sortable(),

                Tables\Columns\TextColumn::make('DataSecurity.jabatan')
                    ->label('Jabatan Security')
                    ->searchable()
                    ->sortable()
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
            RelationManagers\DetailLolosRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListForms::route('/'),
            'edit' => Pages\EditForm::route('/{record}/edit'),
        ];
    }
}
