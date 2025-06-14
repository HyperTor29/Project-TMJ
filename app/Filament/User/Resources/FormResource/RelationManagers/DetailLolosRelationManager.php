<?php

namespace App\Filament\User\Resources\FormResource\RelationManagers;

use Filament\Forms;
use Filament\Tables;
use Illuminate\Database\Eloquent\Builder;
use Filament\Resources\RelationManagers\RelationManager;
use Illuminate\Support\Facades\Auth;

class DetailLolosRelationManager extends RelationManager
{
    protected static string $relationship = 'detailLolos';

    protected static ?string $recordTitleAttribute = null;

    public static function getEloquentQuery(): Builder
    {
        $query = parent::getEloquentQuery();

        if (in_array(Auth::user()->role->name, ['Admin', 'User', 'Validator', 'Viewer'])) {
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

    public function form(Forms\Form $form): Forms\Form
    {
        $userRole = Auth::user()->role->name;

        return $form
            ->schema([
                Forms\Components\Card::make()
                    ->schema([
                        Forms\Components\TimePicker::make('pukul')
                            ->label('Pukul')
                            ->default(now()->setTimezone('Asia/Jakarta')->format('H:i'))
                            ->format('H:i')
                            ->timezone('Asia/Jakarta'),

                        Forms\Components\Select::make('gardu_id')
                            ->label('Gardu (Diisi oleh Security)')
                            ->relationship('Gardu', 'gardu'),

                        Forms\Components\TextInput::make('jumlah_kdr')
                            ->label('Jumlah Kendaraan (Diisi oleh Security)')
                            ->numeric(),

                        Forms\Components\Repeater::make('fotos')
                            ->label('Foto Kendaraan (Diisi oleh Security)')
                            ->relationship('fotos')
                            ->schema([
                                Forms\Components\FileUpload::make('foto')
                                    ->label('Foto Kendaraan')
                                    ->image()
                                    ->maxSize(5120)
                                    ->directory('fotos')
                                    ->imageResizeMode('contain')
                                    ->imageResizeTargetWidth(800),
                            ]),
                    ])
                    ->label('Diisi oleh Security')
                    ->hidden($userRole !== 'Security'),

                Forms\Components\Card::make()
                    ->schema([
                        Forms\Components\TextInput::make('nomor_resi_awal')
                            ->label('Nomor Resi Awal (Diisi oleh CS)'),

                        Forms\Components\TextInput::make('nomor_resi_akhir')
                            ->label('Nomor Resi Akhir (Diisi oleh CS)'),

                        Forms\Components\Select::make('gerbang_id')
                            ->label('Gerbang (Diisi oleh CS)')
                            ->relationship('Gerbang', 'name'),

                        Forms\Components\Select::make('gol_kdr_id')
                            ->label('Golongan Kendaraan (Diisi oleh CS)')
                            ->relationship('GolKdr', 'golongan'),

                        Forms\Components\TextInput::make('nomor_kendaraan')
                            ->label('Nomor Kendaraan (Diisi oleh CS)'),

                        Forms\Components\Select::make('instansi_id')
                            ->label('Instansi (Diisi oleh CS)')
                            ->relationship('Instansi', 'instansi'),

                        Forms\Components\TextInput::make('penanggung_jawab')
                            ->label('Penanggung Jawab (Diisi oleh CS)'),

                        Forms\Components\Checkbox::make('surat_izin_lintas')
                            ->label('Surat Izin Lintas (Diisi oleh CS)')
                            ->live()
                            ->afterStateUpdated(function ($state, callable $set) {
                                if (!$state) {
                                    $set('surats', []);
                                }
                            }),

                        Forms\Components\Repeater::make('surats')
                            ->label('Foto Surat (Diisi oleh CS)')
                            ->relationship('surats')
                            ->schema([
                                Forms\Components\FileUpload::make('surat')
                                    ->label('Foto Surat')
                                    ->image()
                                    ->maxSize(5120)
                                    ->directory('surats')
                                    ->imageResizeMode('contain')
                                    ->imageResizeTargetWidth(800),
                            ])
                            ->visible(fn (callable $get) => $get('surat_izin_lintas') === true)
                            ->hidden(fn (callable $get) => $get('surat_izin_lintas') !== true),
                    ])
                    ->label('Diisi oleh CS')
                    ->hidden($userRole !== 'User'),
            ]);
    }

    public function table(Tables\Table $table): Tables\Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('pukul')
                    ->label('Pukul')
                    ->sortable()
                    ->searchable()
                    ->formatStateUsing(fn ($state) => $state ? \Carbon\Carbon::parse($state)->setTimezone('Asia/Jakarta')->format('H:i') : '-')
                    ->placeholder('-'),

                Tables\Columns\TextColumn::make('Gardu.gardu')
                    ->label('Gardu')
                    ->sortable()
                    ->searchable()
                    ->placeholder('-')
                    ->default('-'),

                Tables\Columns\TextColumn::make('nomor_resi_awal')
                    ->label('Nomor Resi Awal')
                    ->sortable()
                    ->searchable()
                    ->placeholder('-')
                    ->default('-'),

                Tables\Columns\TextColumn::make('nomor_resi_akhir')
                    ->label('Nomor Resi Akhir')
                    ->sortable()
                    ->searchable()
                    ->placeholder('-')
                    ->default('-'),

                Tables\Columns\TextColumn::make('Gerbang.name')
                    ->label('Gerbang')
                    ->sortable()
                    ->searchable()
                    ->placeholder('-')
                    ->default('-'),

                Tables\Columns\TextColumn::make('jumlah_kdr')
                    ->label('Jumlah Kendaraan')
                    ->sortable()
                    ->searchable()
                    ->placeholder('-')
                    ->default('-')
                    ->formatStateUsing(fn ($state) => $state ?? '-'),

                Tables\Columns\TextColumn::make('GolKdr.golongan')
                    ->label('Golongan Kendaraan')
                    ->sortable()
                    ->searchable()
                    ->placeholder('-')
                    ->default('-'),

                Tables\Columns\TextColumn::make('nomor_kendaraan')
                    ->label('Nomor Kendaraan')
                    ->sortable()
                    ->placeholder('-')
                    ->default('-'),

                Tables\Columns\TextColumn::make('Instansi.instansi')
                    ->label('Instansi')
                    ->sortable()
                    ->searchable()
                    ->placeholder('-')
                    ->default('-'),

                Tables\Columns\TextColumn::make('penanggung_jawab')
                    ->label('Penanggung Jawab')
                    ->sortable()
                    ->searchable()
                    ->placeholder('-')
                    ->default('-'),

                Tables\Columns\BooleanColumn::make('surat_izin_lintas')
                    ->label('Surat Izin Lintas')
                    ->trueColor('success')
                    ->falseColor('danger')
                    ->trueIcon('heroicon-o-check-circle')
                    ->falseIcon('heroicon-o-x-circle'),

                Tables\Columns\ImageColumn::make('surats.surat')
                    ->label('Foto Surat')
                    ->getStateUsing(function ($record) {
                        $surat = $record->surats?->first();
                        return $surat ? $surat->surat : null;
                    })
                    ->url(function ($record) {
                        $surat = $record->surats?->first();
                        return $surat && $surat->surat ? asset('storage/' . $surat->surat) : null;
                    })
                    ->defaultImageUrl(asset('images/no-image.png'))
                    ->size(50),

                Tables\Columns\ImageColumn::make('fotos.foto')
                    ->label('Foto Kendaraan')
                    ->getStateUsing(function ($record) {
                        $foto = $record->fotos?->first();
                        return $foto ? $foto->foto : null;
                    })
                    ->url(function ($record) {
                        $foto = $record->fotos?->first();
                        return $foto && $foto->foto ? asset('storage/' . $foto->foto) : null;
                    })
                    ->defaultImageUrl(asset('images/no-image.png'))
                    ->size(50),

                Tables\Columns\TextColumn::make('status')
                    ->label('Status')
                    ->badge()
                    ->formatStateUsing(function ($record) {
                        $securityFilled = $record->gardu_id && $record->jumlah_kdr && $record->fotos?->count() > 0;
                        $csFilled = $record->nomor_resi_awal && $record->nomor_resi_akhir && $record->gerbang_id;

                        if ($securityFilled && $csFilled) {
                            return 'Lengkap';
                        } elseif ($securityFilled || $csFilled) {
                            return 'Sebagian';
                        } else {
                            return 'Kosong';
                        }
                    })
                    ->color(fn (string $state): string => match ($state) {
                        'Lengkap' => 'success',
                        'Sebagian' => 'warning',
                        'Kosong' => 'danger',
                        default => 'secondary',
                    }),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('status')
                    ->label('Status')
                    ->options([
                        'lengkap' => 'Lengkap',
                        'sebagian' => 'Sebagian',
                        'kosong' => 'Kosong',
                    ])
                    ->query(function (Builder $query, array $data): Builder {
                        if (!$data['value']) {
                            return $query;
                        }

                        return match ($data['value']) {
                            'lengkap' => $query->whereNotNull('gardu_id')
                                ->whereNotNull('jumlah_kdr')
                                ->whereNotNull('nomor_resi_awal')
                                ->whereNotNull('nomor_resi_akhir')
                                ->whereNotNull('gerbang_id'),
                            'sebagian' => $query->where(function ($q) {
                                $q->whereNotNull('gardu_id')
                                  ->orWhereNotNull('nomor_resi_awal');
                            }),
                            'kosong' => $query->whereNull('gardu_id')
                                ->whereNull('nomor_resi_awal'),
                            default => $query,
                        };
                    }),
            ])
            ->headerActions([
                Tables\Actions\CreateAction::make()
                    ->label('New Detail')
                    ->modalSubmitActionLabel('Save'),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make()
                    ->label('Delete'),
            ]);
    }
}
