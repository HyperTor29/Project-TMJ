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
        return parent::getEloquentQuery()->where('user_id', Auth::id());
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

                // Columns DetailLolos model
                // Tables\Columns\TextColumn::make('DetailLolos.pukul')
                //     ->label('Pukul')
                //     ->searchable()
                //     ->sortable(),

                // Tables\Columns\TextColumn::make('DetailLolos.Gardu.gardu')
                //     ->label('Gardu')
                //     ->searchable()
                //     ->sortable(),

                // Tables\Columns\TextColumn::make('DetailLolos.nomor_resi_awal')
                //     ->label('Nomor Resi Awal')
                //     ->searchable()
                //     ->sortable(),

                // Tables\Columns\TextColumn::make('DetailLolos.nomor_resi_akhir')
                //     ->label('Nomor Resi Akhir')
                //     ->searchable()
                //     ->sortable(),

                // Tables\Columns\TextColumn::make('DetailLolos.Gerbang.name')
                //     ->label('Gerbang')
                //     ->searchable()
                //     ->sortable(),

                // Tables\Columns\TextColumn::make('DetailLolos.jumlah_kdr')
                //     ->label('Jumlah Kendaraan')
                //     ->searchable()
                //     ->sortable(),

                // Tables\Columns\TextColumn::make('DetailLolos.GolKdr.golongan')
                //     ->label('Golongan Kendaraan')
                //     ->searchable()
                //     ->sortable(),

                // Tables\Columns\TextColumn::make('DetailLolos.nomor_kendaraan')
                //     ->label('Nomor Kendaraan')
                //     ->searchable()
                //     ->sortable(),

                // Tables\Columns\TextColumn::make('DetailLolos.Instansi.instansi')
                //     ->label('Instansi')
                //     ->searchable()
                //     ->sortable(),

                // Tables\Columns\TextColumn::make('DetailLolos.penanggung_jawab')
                //     ->label('Penanggung Jawab')
                //     ->searchable()
                //     ->sortable(),

                // Tables\Columns\CheckboxColumn::make('DetailLolos.surat_izin_lintas')
                //     ->label('Surat Izin Lintas'),

                // Tables\Columns\ImageColumn::make('DetailLolos.surats.surat')
                //     ->label('Foto Surat')
                //     ->url(fn ($record) => asset('storage/' . $record->surat)),

                // Tables\Columns\ImageColumn::make('DetailLolos.fotos.foto')
                //     ->label('Foto Kendaraan')
                //     ->url(fn ($record) => asset('storage/' . $record->foto)),
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
                Tables\Actions\DeleteBulkAction::make(),
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
