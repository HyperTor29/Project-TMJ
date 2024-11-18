<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use App\Models\Form;
use App\Models\DetailLolos;
use App\Filament\Resources\RekapResource\Pages;

class RekapResource extends Resource
{
    protected static ?string $model = Form::class;
    protected static ?string $detailLolosModel = DetailLolos::class;

    protected static ?string $navigationIcon = 'heroicon-o-clipboard';
    protected static ?string $navigationGroup = 'Laporan';
    protected static ?string $navigationLabel = 'Rekapan';
    protected static ?int $navigationSort = 23;

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                // Columns from Form model (FormResource)
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

                // Columns from DetailLolos model (DetailLolosResource)
                Tables\Columns\TextColumn::make('id')
                    ->label('Id')
                    ->searchable()
                    ->sortable(),

                Tables\Columns\TextColumn::make('pukul')
                    ->label('Pukul')
                    ->searchable()
                    ->sortable(),

                Tables\Columns\TextColumn::make('Gardu.gardu')
                    ->label('Gardu')
                    ->searchable()
                    ->sortable(),

                Tables\Columns\TextColumn::make('nomor_resi_awal')
                    ->label('Nomor Resi Awal')
                    ->searchable()
                    ->sortable(),

                Tables\Columns\TextColumn::make('nomor_resi_akhir')
                    ->label('Nomor Resi Akhir')
                    ->searchable()
                    ->sortable(),

                Tables\Columns\TextColumn::make('Gerbang.name')
                    ->label('Gerbang')
                    ->searchable()
                    ->sortable(),

                Tables\Columns\TextColumn::make('jumlah_kdr')
                    ->label('Jumlah Kendaraan')
                    ->searchable()
                    ->sortable(),

                Tables\Columns\TextColumn::make('GolKdr.golongan')
                    ->label('Golongan Kendaraan')
                    ->searchable()
                    ->sortable(),

                Tables\Columns\TextColumn::make('nomor_kendaraan')
                    ->label('Nomor Kendaraan')
                    ->searchable()
                    ->sortable(),

                Tables\Columns\TextColumn::make('Instansi.instansi')
                    ->label('Instansi')
                    ->searchable()
                    ->sortable(),

                Tables\Columns\TextColumn::make('penanggung_jawab')
                    ->label('Penanggung Jawab')
                    ->searchable()
                    ->sortable(),

                Tables\Columns\CheckboxColumn::make('surat_izin_lintas')
                    ->label('Surat Izin Lintas')
                    ->searchable(),
            ])
            ->filters([
                // Add any necessary filters for data refinement
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
            // Define any necessary relations here
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListRekaps::route('/'),
        ];
    }
}
