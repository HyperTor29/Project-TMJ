<?php

namespace App\Filament\Validator\Resources\FormResource\RelationManagers;

use Filament\Forms;
use Filament\Tables;
use Illuminate\Database\Eloquent\Builder;
use Filament\Resources\RelationManagers\RelationManager;
use Illuminate\Support\Facades\Auth;

class DetailLolosRelationManager extends RelationManager
{
    protected static string $relationship = 'detailLolos';

    protected static ?string $recordTitleAttribute = 'id';

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

    // public function form(Forms\Form $form): Forms\Form
    // {
    //     return $form
    //         ->schema([
    //             Forms\Components\TimePicker::make('pukul')
    //                 ->label('Pukul')
    //                 // ->default(now()->setTimezone('Asia/Jakarta'))
    //                 ->required(),

    //             Forms\Components\Select::make('gardu_id')
    //                 ->label('Gardu')
    //                 ->relationship('Gardu', 'gardu')
    //                 ->required(),

    //             Forms\Components\TextInput::make('nomor_resi_awal')
    //                 ->label('Nomor Resi Awal')
    //                 ->required(),

    //             Forms\Components\TextInput::make('nomor_resi_akhir')
    //                 ->label('Nomor Resi Akhir')
    //                 ->required(),

    //             Forms\Components\Select::make('gerbang_id')
    //                 ->label('Gerbang')
    //                 ->relationship('Gerbang', 'name')
    //                 ->required(),

    //             Forms\Components\TextInput::make('jumlah_kdr')
    //                 ->label('Jumlah Kendaraan')
    //                 ->required(),

    //             Forms\Components\Select::make('gol_kdr_id')
    //                 ->label('Golongan Kendaraan')
    //                 ->relationship('GolKdr', 'golongan')
    //                 ->required(),

    //             Forms\Components\TextInput::make('nomor_kendaraan')
    //                 ->label('Nomor Kendaraan')
    //                 ->required(),

    //             Forms\Components\Select::make('instansi_id')
    //                 ->label('Instansi')
    //                 ->relationship('Instansi', 'instansi')
    //                 ->required(),

    //             Forms\Components\TextInput::make('penanggung_jawab')
    //                 ->label('Penanggung Jawab')
    //                 ->required(),

    //             Forms\Components\Checkbox::make('surat_izin_lintas')
    //                 ->label('Surat Izin Lintas'),

    //             Forms\Components\Repeater::make('surats')
    //                 ->label('Foto Surat')
    //                 ->relationship('surats')
    //                 ->schema([
    //                     Forms\Components\FileUpload::make('surat')
    //                         ->label('Foto Surat')
    //                         ->image()
    //                         ->maxSize(5120)
    //                         ->required(),
    //                 ]),

    //             Forms\Components\Repeater::make('fotos')
    //                 ->label('Foto')
    //                 ->relationship('fotos')
    //                 ->schema([
    //                     Forms\Components\FileUpload::make('foto')
    //                         ->label('Foto Kendaraan')
    //                         ->image()
    //                         ->maxSize(5120)
    //                         ->required(),
    //                 ]),

    //             Forms\Components\Select::make('status')
    //                 ->label('Status')
    //         ]);
    // }

    public function table(Tables\Table $table): Tables\Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('id')
                    ->label('ID')
                    ->sortable()
                    ->searchable(),

                Tables\Columns\TextColumn::make('pukul')
                    ->label('Pukul')
                    ->sortable()
                    ->searchable(),

                Tables\Columns\TextColumn::make('Gardu.gardu')
                    ->label('Gardu')
                    ->sortable()
                    ->searchable(),

                Tables\Columns\TextColumn::make('nomor_resi_awal')
                    ->label('Nomor Resi Awal')
                    ->sortable()
                    ->searchable(),

                Tables\Columns\TextColumn::make('nomor_resi_akhir')
                    ->label('Nomor Resi Akhir')
                    ->sortable()
                    ->searchable(),

                Tables\Columns\TextColumn::make('Gerbang.name')
                    ->label('Gerbang')
                    ->sortable()
                    ->searchable(),

                Tables\Columns\TextColumn::make('jumlah_kdr')
                    ->label('Jumlah Kendaraan')
                    ->sortable()
                    ->searchable(),

                Tables\Columns\TextColumn::make('GolKdr.golongan')
                    ->label('Golongan Kendaraan')
                    ->sortable()
                    ->searchable(),

                Tables\Columns\TextColumn::make('nomor_kendaraan')
                    ->label('Nomor Kendaraan')
                    ->sortable(),

                Tables\Columns\TextColumn::make('Instansi.instansi')
                    ->label('Instansi')
                    ->sortable()
                    ->searchable(),

                Tables\Columns\TextColumn::make('penanggung_jawab')
                    ->label('Penanggung Jawab')
                    ->sortable()
                    ->searchable(),

                Tables\Columns\CheckboxColumn::make('surat_izin_lintas')
                    ->label('Surat Izin Lintas'),

                Tables\Columns\ImageColumn::make('surats.surat')
                    ->label('Foto Surat')
                    ->url(fn ($record) => asset('storage/' . $record->surat)),

                Tables\Columns\ImageColumn::make('fotos.foto')
                    ->label('Foto Kendaraan')
                    ->url(fn ($record) => asset('storage/' . $record->foto)),

                Tables\Columns\TextColumn::make('status')
                    ->label('Status')
            ])
            ->filters([])
            ->headerActions([
                // Tables\Actions\CreateAction::make(),
            ])
            ->actions([
                // Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                // Tables\Actions\DeleteBulkAction::make(),
            ]);
    }
}
