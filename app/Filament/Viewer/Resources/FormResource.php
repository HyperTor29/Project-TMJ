<?php

namespace App\Filament\Viewer\Resources;

use App\Filament\Viewer\Resources\FormResource\Pages;
use App\Filament\Viewer\Resources\FormResource\RelationManagers;
use App\Models\Form;
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
        $query = parent::getEloquentQuery();

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
