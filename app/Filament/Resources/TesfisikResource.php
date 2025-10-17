<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
use App\Models\Tesfisik;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Filament\Resources\Resource;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Fieldset;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Illuminate\Database\Eloquent\Builder;
use App\Filament\Resources\TesfisikResource\Pages;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\TesfisikResource\RelationManagers;

class TesfisikResource extends Resource
{
    protected static ?string $model = Tesfisik::class;

    protected static ?string $navigationIcon = 'heroicon-o-heart';
    protected static ?string $navigationGroup = 'PPDB';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Fieldset::make('Data Siswa')
                ->relationship('siswa')
                ->schema([
                    TextInput::make('nama')
                        ->label('Nama Siswa')
                        ->disabled(),
                    TextInput::make('nomor_pendaftaran')
                        ->label('Nomor Pendaftaran')
                        ->disabled(),
                ])
                ->columns(2),
                Section::make('Hasil Tes Fisik')
                ->schema([
                    TextInput::make('tinggi')
                        ->label('Tinggi Badan (cm)')
                        ->numeric()
                        ->required(),
                    TextInput::make('berat')
                        ->label('Berat Badan (kg)')
                        ->numeric()
                        ->required(),
                    Select::make('mata')
                        ->label('Kondisi Mata')
                        ->options([
                            'N' => 'Normal',
                            'BW' => 'Buta Warna',
                            'RD' => 'Rabun Dekat',
                            'RJ' => 'Rabun Jauh',
                            'P' => 'Pakai Kacamata',
                            'M' => 'Minus',
                        ])
                        ->required(),
                    Select::make('telinga')
                        ->label('Kondisi Telinga')
                        ->options([
                            'N' => 'Normal',
                            'KNK' => 'Kurang Normal Kiri',
                            'KRK' => 'Kurang Normal Kanan',
                        ])
                        ->required(),
                    Select::make('obat')
                        ->label('Mengonsumsi Obat Rutin?')
                        ->options([
                            0 => 'Tidak',
                            1 => 'Ya',
                        ])
                        ->required(),
                    TextInput::make('penyakit')
                        ->label('Penyakit yang Pernah Diderita')
                        ->nullable(),
                    Select::make('tato')
                        ->label('Tato')
                        ->options([
                            'N' => 'Tidak Ada',
                            'TA' => 'Tato Ada',
                            'TI' => 'Tindik',
                        ])
                        ->required(),
                    Select::make('disabilitas')
                        ->label('Disabilitas')
                        ->options([
                            'N' => 'Tidak Ada',
                            'TW' => 'Tuna Wicara',
                            'TR' => 'Tuna Rungu',
                            'TN' => 'Tuna Netra',
                            'TD' => 'Tuna Daksa',
                            'TG' => 'Tuna Grahita',
                        ])
                        ->required(),
                    Select::make('ibadah')
                        ->label('Ibadah')
                        ->options([
                            'B' => 'Baik',
                            'C' => 'Cukup',
                            'K' => 'Kurang',
                        ])
                        ->required(),
                    Select::make('alquran')
                        ->label('Kemampuan Membaca Al-Qur\'an')
                        ->options([
                            'S' => 'Sangat Baik',
                            'B' => 'Baik',
                            'T' => 'Tidak Bisa',
                        ])
                        ->required(),
                    Select::make('membaca')
                        ->label('Kemampuan Membaca')
                        ->options([
                            'L' => 'Lancar',
                            'KL' => 'Kurang Lancar',
                            'TB' => 'Tidak Bisa',
                        ])
                        ->required(),
                    Select::make('ukuran_baju')
                        ->label('Ukuran Baju')
                        ->options([
                            'S' => 'S',
                            'M' => 'M',
                            'L' => 'L',
                            'XL' => 'XL',
                            'XXL' => 'XXL',
                            'XXXL' => 'XXXL',
                        ])
                        ->required(),
                    Textarea::make('akademik')
                        ->label('Prestasi Akademik')
                        ->nullable()
                        ->columnSpanFull(),
                    Textarea::make('non_akademik')
                        ->label('Prestasi Non Akademik')
                        ->nullable()
                        ->columnSpanFull(),
                ])
                ->columns(2),
                
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('siswa.nama')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('tinggi')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('berat')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('mata')
                    ->formatStateUsing(function ($state) {
                        return match ($state) {
                            'N' => 'Normal',
                            'BW' => 'Buta Warna',
                            'RD' => 'Rabun Dekat',
                            'RJ' => 'Rabun Jauh',
                            'P' => 'Pakai Kacamata',
                            'M' => 'Minus',
                            default => $state,
                        };
                    }),
                Tables\Columns\TextColumn::make('telinga')
                    ->formatStateUsing(function ($state) {
                        return match ($state) {
                            'N' => 'Normal',
                            'KNK' => 'Kurang Normal Kiri',
                            'KRK' => 'Kurang Normal Kanan',
                            default => $state,
                        };
                    }),
                Tables\Columns\IconColumn::make('obat')
                    ->boolean(),
                Tables\Columns\TextColumn::make('penyakit')
                    ->searchable(),
                Tables\Columns\TextColumn::make('tato')
                    ->formatStateUsing(function ($state) {
                        return match ($state) {
                            'N' => 'Tidak Ada',
                            'TA' => 'Tato Ada',
                            'TI' => 'Tindik',
                            default => $state,
                        };
                    }),
                Tables\Columns\TextColumn::make('disabilitas')
                    ->formatStateUsing(function ($state) {
                        return match ($state) {
                            'N' => 'Tidak Ada',
                            'TW' => 'Tuna Wicara',
                            'TR' => 'Tuna Rungu',
                            'TN' => 'Tuna Netra',
                            'TD' => 'Tuna Daksa',
                            'TG' => 'Tuna Grahita',
                            default => $state,
                        };
                    }),
                Tables\Columns\TextColumn::make('ibadah')
                    ->formatStateUsing(function ($state) {
                        return match ($state) {
                            'B' => 'Baik',
                            'C' => 'Cukup',
                            'K' => 'Kurang',
                            default => $state,
                        };
                    }),
                Tables\Columns\TextColumn::make('alquran')
                    ->formatStateUsing(function ($state) {
                        return match ($state) {
                            'S' => 'Sangat Baik',
                            'B' => 'Baik',
                            'T' => 'Tidak Bisa',
                            default => $state,
                        };
                    }),
                Tables\Columns\TextColumn::make('membaca')
                    ->formatStateUsing(function ($state) {
                        return match ($state) {
                            'L' => 'Lancar',
                            'KL' => 'Kurang Lancar',
                            'TB' => 'Tidak Bisa',
                            default => $state,
                        };
                    }),
                Tables\Columns\TextColumn::make('ukuran_baju'),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                
            ])
            ->defaultSort('created_at', 'desc')
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
   Tables\Actions\DeleteAction::make(),

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
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListTesfisiks::route('/'),
            'create' => Pages\CreateTesfisik::route('/create'),
            //'edit' => Pages\EditTesfisik::route('/{record}/edit'),
        ];
    }
}
