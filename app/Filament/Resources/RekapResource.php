<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use App\Models\Form;
use App\Models\DetailLolos;
use App\Filament\Resources\RekapResource\Pages;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Builder;

class RekapResource extends Resource
{
    protected static ?string $model = Form::class;

    protected static ?string $detailLolosModel = DetailLolos::class;

    protected static ?string $navigationIcon = 'heroicon-o-clipboard';

    protected static ?string $navigationGroup = 'Laporan';

    protected static ?string $navigationLabel = 'Rekap Data';

    protected static ?int $navigationSort = 23;

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
                // Columns Form model
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

            ])
            ->filters([
                // Add necessary filters
            ])
            ->actions([
                // Tables\Actions\EditAction::make(),
                Tables\Actions\Action::make('view')
                    ->label('View')
                    ->icon('heroicon-o-eye')
                    ->url(fn ($record) => static::getUrl('view', ['record' => $record->id])),

            ])
            ->bulkActions([
                // Tables\Actions\DeleteBulkAction::make(),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            // Define any relations if needed
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListRekaps::route('/'),
            'view' => Pages\ViewRekap::route('/view/{record}'),
        ];
    }
}
