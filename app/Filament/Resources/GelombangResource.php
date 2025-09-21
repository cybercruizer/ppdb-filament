<?php

namespace App\Filament\Resources;

use App\Filament\Resources\GelombangResource\Pages;
use App\Filament\Resources\GelombangResource\RelationManagers;
use App\Models\Gelombang;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class GelombangResource extends Resource
{
    protected static ?string $model = Gelombang::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';
    protected static ?string $navigationGroup = 'Data Dasar';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('kode_gelombang')
                    ->required()
                    ->maxLength(255)
                    ->unique(ignoreRecord: true),
                Forms\Components\TextInput::make('nama_gelombang')
                    ->required()
                    ->maxLength(255),
                Forms\Components\Select::make('tahun_id')
                    ->relationship('tahun', 'nama_tahun')
                    ->required()
                    ->label('Tahun'),
                Forms\Components\DatePicker::make('tanggal_mulai')
                    ->required()
                    ->label('Tanggal Mulai')
                    ->placeholder('Pilih Tanggal Mulai'),
                Forms\Components\DatePicker::make('tanggal_selesai')
                    ->required()
                    ->label('Tanggal Selesai')
                    ->placeholder('Pilih Tanggal Selesai'),
                Forms\Components\TextInput::make('biaya')
                    ->required()
                    ->numeric()
                    ->label('Biaya')
                    ->placeholder('Masukkan Biaya'),
                Forms\Components\Textarea::make('keterangan')
                    ->label('Keterangan')
                    ->placeholder('Masukkan Keterangan'),
                Forms\Components\Toggle::make('is_active')
                    ->label('Aktif')
                    ->default(false)
                    ->required(),
            ])->columns([
                'sm' => 2,
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('id')
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('kode_gelombang')
                    ->sortable()
                    ->searchable()
                    ->label('Kode Gelombang'),
                Tables\Columns\TextColumn::make('nama_gelombang')
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('tanggal_mulai')
                    ->date()
                    ->sortable()
                    ->searchable()
                    ->label('Tanggal Mulai'),
                Tables\Columns\TextColumn::make('tanggal_selesai')
                    ->date()
                    ->sortable()
                    ->searchable()
                    ->label('Tanggal Selesai'),
                Tables\Columns\TextColumn::make('tahun.nama_tahun')
                    ->sortable()
                    ->searchable()
                    ->label('Tahun'),
                Tables\Columns\ToggleColumn::make('is_active')
                    ->label('Status')
                    ->onColor('success')
                    ->offColor('danger')
                    ->beforeStateUpdated(function (Gelombang $record) {
                        Gelombang::where('id', '!=', $record->id)->update(['is_active' => false]);
                    })
                    ->action(function (Gelombang $record, bool $state): void {
                        $record->update(['is_active' => $state]);
                    }),
                Tables\Columns\TextColumn::make('biaya')
                    ->sortable()
                    ->searchable()
                    ->label('Biaya')
                    ->money('IDR', true),
            ])
            ->filters([
                //make filter for tahun.nama_tahun
                Tables\Filters\SelectFilter::make('tahun_id')
                    ->relationship('tahun', 'nama_tahun')
                    ->label('Tahun'),
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

    public static function getPages(): array
    {
        return [
            'index' => Pages\ManageGelombangs::route('/'),
        ];
    }
}
