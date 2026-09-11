<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Forms\Components\Textarea;
use Filament\Tables;
use Filament\Forms\Form;
use App\Models\CalonMurid;
use Filament\Tables\Table;
use Filament\Resources\Resource;
use Filament\Tables\Columns\TextColumn;
use Illuminate\Support\Facades\Storage;
use Filament\Forms\Components\TextInput;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\CalonMuridResource\Pages;
use App\Filament\Resources\CalonMuridResource\RelationManagers;

class CalonMuridResource extends Resource
{
    protected static ?string $model = CalonMurid::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';
    protected static ?string $navigationGroup = 'Pendataan Calon Murid';
    protected static ?string $label = 'Calon Murid';
    protected static ?string $navigationLabel = 'Calon Murid';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('nik')
                ->required()
                ->numeric()
                ->label('NIK')
                ->length(16)
                ->unique(),
                Forms\Components\TextInput::make('nama')
                ->required(),
                Forms\Components\TextInput::make('asal_smp')
                ->required(),
                Forms\Components\Textarea::make('alamat')
                ->placeholder('Jalan, RT, RW, Dusun, Desa, Kecamatan, Kabupaten')
                ->required(),
                Forms\Components\TextInput::make('nama_ortu')
                ->required(),
                Forms\Components\TextInput::make('no_wa')
                ->placeholder('08xxxxxxxx')
                ->required(),
                Forms\Components\FileUpload::make('scan_kk')
                ->required(),
                Forms\Components\Select::make('murid_pendamping_id')
                ->relationship('muridPendamping', 'nama'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('nik')
                ->searchable(),
                TextColumn::make('nama')
                ->searchable()
                ->sortable(),
                TextColumn::make('asal_smp')
                ->searchable()
                ->sortable(),
                TextColumn::make('alamat')
                ->searchable(),
                TextColumn::make('nama_ortu')
                ->searchable(),
                TextColumn::make('no_wa')
                ->searchable(),
                TextColumn::make('muridPendamping.nama'),
                TextColumn::make('scan_kk')
                ->url(fn($record) => Storage::url($record->scan_kk))
                ->openUrlInNewTab(true)
                ->label('Scan KK'),
                
            ])
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
            'index' => Pages\ListCalonMurids::route('/'),
            'create' => Pages\CreateCalonMurid::route('/create'),
            'edit' => Pages\EditCalonMurid::route('/{record}/edit'),
        ];
    }
}
