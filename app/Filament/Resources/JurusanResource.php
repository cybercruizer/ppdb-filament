<?php

namespace App\Filament\Resources;

use App\Filament\Resources\JurusanResource\Pages;
use App\Filament\Resources\JurusanResource\RelationManagers;
use App\Models\Jurusan;
use Filament\Forms;
use Filament\Forms\Components\Group;
use Filament\Forms\Components\Section;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use FilamentTiptapEditor\TiptapEditor;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use RalphJSmit\Filament\SEO\SEO;

class JurusanResource extends Resource
{
    protected static ?string $model = Jurusan::class;

    protected static ?string $navigationIcon = 'heroicon-o-arrows-pointing-out';
    protected static ?string $navigationGroup = 'Data Dasar';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('kode_jurusan')
                    ->required()
                    ->maxLength(5)
                    ->unique(ignoreRecord: true),
                Forms\Components\TextInput::make('nama_jurusan')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('deskripsi_singkat')
                    ->label('Deskripsi Singkat')
                    ->maxLength(255)
                    ->afterStateUpdated(function ($state, callable $set) {
                        if (!empty($state)) {
                            $set('seo.description', $state);
                        }
                    }),
                Forms\Components\TextInput::make('icon')
                    ->maxLength(100)
                    ->helperText('Masukkan nama kelas ikon dari Heroicons, misal: academic-cap'),
                TiptapEditor::make('deskripsi')
                    ->label('Deskripsi Lengkap')
                    ->required()
                    ->columnSpanFull(),
                Section::make('SEO (Search Engine Optimization)')
                    ->description('Pengaturan SEO untuk halaman ini.')
                    ->schema([
                        SEO::make(),
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('id')
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('kode_jurusan')
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('nama_jurusan')
                    ->sortable()
                    ->searchable(),
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

    public static function getPages(): array
    {
        return [
            'index' => Pages\ManageJurusans::route('/'),
        ];
    }
}
