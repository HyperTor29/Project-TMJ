<?php

namespace App\Filament\User\Resources;

use App\Filament\User\Resources\FormResource\Pages;
use App\Filament\User\Resources\FormResource\RelationManagers;
use App\Models\Form;
use Filament\Forms;
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
        return 'Form';
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

    public static function form(Forms\Form $form): Forms\Form
    {
        return $form->schema(function () {
            $user = Auth::user();
            $dataCs = \App\Models\DataCs::where('nama', $user->name)->first();

            return [
                Forms\Components\DatePicker::make('tanggal')
                    ->label('Tanggal')
                    ->required()
                    ->format('d/m/Y')
                    ->locale('id'),

                Forms\Components\Select::make('gerbang_tujuan_id')
                    ->label('Gerbang Tol')
                    ->relationship('GerbangTujuan', 'name')
                    ->required(),

                Forms\Components\Select::make('shifts_id')
                    ->label('Shift')
                    ->relationship('Shifts', 'shift')
                    ->required(),

                Forms\Components\Select::make('data_cs_id')
                    ->label('Nama CS')
                    ->relationship('DataCs', 'nama')
                    ->required()
                    ->reactive()
                    ->afterStateUpdated(function ($state, callable $set) {
                        $data = \App\Models\DataCs::find($state);
                        $set('data_cs_nik_display', $data?->nik);
                        $set('data_cs_jabatan_display', $data?->jabatan);
                    }),

                Forms\Components\TextInput::make('data_cs_nik_display')
                    ->label('NIK CS')
                    ->disabled()
                    ->dehydrated(false)
                    ->afterStateHydrated(function (Forms\Components\TextInput $component, $state, $record) {
                        if ($record && $record->DataCs) {
                            $component->state($record->DataCs->nik);
                        }
                    }),

                Forms\Components\TextInput::make('data_cs_jabatan_display')
                    ->label('Jabatan CS')
                    ->disabled()
                    ->dehydrated(false)
                    ->afterStateHydrated(function (Forms\Components\TextInput $component, $state, $record) {
                        if ($record && $record->DataCs) {
                            $component->state($record->DataCs->jabatan);
                        }
                    }),

                Forms\Components\Select::make('data_css_id')
                    ->label('Nama CSS')
                    ->relationship('DataCss', 'nama')
                    ->required()
                    ->reactive()
                    ->afterStateUpdated(function ($state, callable $set) {
                        $data = \App\Models\DataCss::find($state);
                        $set('data_css_nik_display', $data?->nik);
                        $set('data_css_jabatan_display', $data?->jabatan);
                    }),

                Forms\Components\TextInput::make('data_css_nik_display')
                    ->label('NIK CSS')
                    ->disabled()
                    ->dehydrated(false)
                    ->afterStateHydrated(function (Forms\Components\TextInput $component, $state, $record) {
                        if ($record && $record->DataCss) {
                            $component->state($record->DataCss->nik);
                        }
                    }),

                Forms\Components\TextInput::make('data_css_jabatan_display')
                    ->label('Jabatan CSS')
                    ->disabled()
                    ->dehydrated(false)
                    ->afterStateHydrated(function (Forms\Components\TextInput $component, $state, $record) {
                        if ($record && $record->DataCss) {
                            $component->state($record->DataCss->jabatan);
                        }
                    }),

                Forms\Components\Select::make('asmen_id')
                    ->label('Nama Asmen')
                    ->relationship('Asmen', 'nama')
                    ->required()
                    ->reactive()
                    ->afterStateUpdated(function ($state, callable $set) {
                        $data = \App\Models\Asmen::find($state);
                        $set('asmen_nik_display', $data?->nik);
                        $set('asmen_jabatan_display', $data?->jabatan);
                    }),

                Forms\Components\TextInput::make('asmen_nik_display')
                    ->label('NIK Asmen')
                    ->disabled()
                    ->dehydrated(false)
                    ->afterStateHydrated(function (Forms\Components\TextInput $component, $state, $record) {
                        if ($record && $record->Asmen) {
                            $component->state($record->Asmen->nik);
                        }
                    }),

                Forms\Components\TextInput::make('asmen_jabatan_display')
                    ->label('Jabatan Asmen')
                    ->disabled()
                    ->dehydrated(false)
                    ->afterStateHydrated(function (Forms\Components\TextInput $component, $state, $record) {
                        if ($record && $record->Asmen) {
                            $component->state($record->Asmen->jabatan);
                        }
                    }),

                Forms\Components\Select::make('data_securities_id')
                    ->label('Nama Security')
                    ->relationship('DataSecurity', 'nama')
                    ->required()
                    ->reactive()
                    ->afterStateUpdated(function ($state, callable $set) {
                        $data = \App\Models\DataSecurity::find($state);
                        $set('data_security_jabatan_display', $data?->jabatan);
                    }),

                Forms\Components\TextInput::make('data_security_jabatan_display')
                    ->label('Jabatan Security')
                    ->disabled()
                    ->dehydrated(false)
                    ->afterStateHydrated(function (Forms\Components\TextInput $component, $state, $record) {
                        if ($record && $record->DataSecurity) {
                            $component->state($record->DataSecurity->jabatan);
                        }
                    }),
            ];
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
                    ->label('Gerbang Tujuan')
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
