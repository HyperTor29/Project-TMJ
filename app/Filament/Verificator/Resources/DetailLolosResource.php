<?php

namespace App\Filament\Verificator\Resources;

use App\Filament\Verificator\Resources\DetailLolosResource\Pages;
use App\Models\DetailLolos;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Builder;

class DetailLolosResource extends Resource
{
    protected static ?string $model = DetailLolos::class;

    protected static ?string $navigationIcon = 'heroicon-o-arrow-down-on-square-stack';

    protected static ?string $navigationGroup = 'Laporan';

    protected static ?int $navigationSort = 12;

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()->where('user_id', Auth::id());
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                //
                Forms\Components\TextInput::make('id')
                ->label('ID')
                ->disabled()
                ->visible(fn ($record) => $record)
                ->columnSpan('full'),

                Forms\Components\TimePicker::make('pukul')
                ->label('Pukul')
                ->default(now()->setTimezone('Asia/Jakarta'))
                ->required(),

                Forms\Components\Select::make('gardu_id')
                ->label('Gardu')
                ->relationship('Gardu', 'gardu')
                ->required(),

                Forms\Components\TextInput::make('nomor_resi_awal')
                ->label('Nomor Resi Awal')
                ->required(),

                Forms\Components\TextInput::make('nomor_resi_akhir')
                ->label('Nomor Resi Akhir')
                ->required(),

                Forms\Components\Select::make('gerbang_id')
                ->label('Gerbang')
                ->relationship('Gerbang', 'name')
                ->required(),

                Forms\Components\TextInput::make('jumlah_kdr')
                ->label('Jumlah Kendaraan')
                ->required(),

                Forms\Components\Select::make('gol_kdr_id')
                ->label('Golongan Kendaraan')
                ->relationship('GolKdr', 'golongan')
                ->required(),

                Forms\Components\TextInput::make('nomor_kendaraan')
                ->label('Nomor Kendaraan')
                ->required(),

                Forms\Components\Select::make('instansi_id')
                ->label('Instansi')
                ->relationship('Instansi', 'instansi')
                ->required(),

                Forms\Components\TextInput::make('penanggung_jawab')
                ->label('Penanggung Jawab')
                ->required(),

                Forms\Components\Checkbox::make('surat_izin_lintas')
                ->label('Surat Izin Lintas'),

                Forms\Components\Repeater::make('surats')
                ->label('Foto Surat')
                ->relationship('surats')
                ->schema([
                    Forms\Components\FileUpload::make('surat')
                    ->label('Foto Surat')
                    ->image()
                    ->maxSize(5120)
                    ->required(),
                ]),

                Forms\Components\Repeater::make('fotos')
                ->label('Foto')
                ->relationship('fotos')
                ->schema([
                    Forms\Components\FileUpload::make('foto')
                    ->label('Foto Kendaraan')
                    ->image()
                    ->maxSize(5120)
                    ->required(),
                ]),

                Forms\Components\Select::make('status')
                ->label('Status')
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                //
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

                Tables\Columns\ImageColumn::make('surats.surat')
                ->label('Foto Surat')
                ->url(fn ($record) => asset('storage/' . $record->surat)),

                Tables\Columns\ImageColumn::make('fotos.foto')
                ->label('Foto Kendaraan')
                ->url(fn ($record) => asset('storage/' . $record->foto)),

                Tables\Columns\TextColumn::make('status')
                ->label('Status')
                ->searchable()
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make()
                    ->label('Delete'),
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
            'index' => Pages\ListDetailLolos::route('/'),
            'create' => Pages\CreateDetailLolos::route('/create'),
            'edit' => Pages\EditDetailLolos::route('/{record}/edit'),
        ];
    }
}
