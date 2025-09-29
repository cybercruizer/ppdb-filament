<?php

namespace App\Filament\Resources;

use Filament\Forms;
use App\Models\Post;
use Filament\Tables;
use Filament\Forms\Set;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Illuminate\Support\Str;
use Filament\Infolists\Infolist;
use Filament\Resources\Resource;
use RalphJSmit\Filament\SEO\SEO;
use Filament\Tables\Actions\Action;
use Filament\Forms\Components\Section;
use FilamentTiptapEditor\TiptapEditor;
use Illuminate\Database\Eloquent\Builder;
use Filament\Infolists\Components\TextEntry;
use App\Filament\Resources\PostResource\Pages;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\PostResource\RelationManagers;

class PostResource extends Resource
{
    protected static ?string $model = Post::class;

    protected static ?string $navigationIcon = 'heroicon-o-computer-desktop';
    protected static ?string $navigationGroup = 'Manage Website';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('title')
                    ->label('Judul')
                    ->required()
                    ->maxLength(160)
                    ->live(onBlur: true) ->afterStateUpdated(function (Set $set, $state) {
                        $set('slug', Str::slug($state));
                        $set('seo.title',$state);
                        }),
                Forms\Components\TextInput::make('slug')
                    ->label('Link Slug'),
                Forms\Components\TextInput::make('urutan')
                    ->numeric()
                    ->default(0)
                    ->required(),
                Forms\Components\Select::make('category')
                    ->options([
                        'info' => 'Informasi',
                        'syarat' => 'Syarat',
                        'pengumuman' => 'Pengumuman',
                    ])
                    ->required(),
                TiptapEditor::make('content')
                    ->required()
                    ->columnSpanFull()
                    ->extraInputAttributes(['style' => 'min-height: 12rem;']),
                Section::make('SEO (Search Engine Optimization)')
                    ->description('Pengaturan SEO untuk halaman ini.')
                    ->schema([
                        SEO::make(),
                    ]),
                
            ]);
    }
    public static function infolist(Infolist $infolist): Infolist
    {
        return $infolist
            ->schema([
                Textentry::make('title')->label('Judul'),
                Textentry::make('category')->label('Kategori'),
                Textentry::make('content')->label('Konten')->html(),
                Textentry::make('created_at')->label('Dibuat pada')->dateTime(),
                Textentry::make('updated_at')->label('Diperbarui pada')->dateTime(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('title')->label('Judul')->sortable()->searchable(),
                Tables\Columns\TextColumn::make('urutan')->label('Urutan')->sortable(),
                Tables\Columns\TextColumn::make('category')->label('Kategori')->sortable(),
                Tables\Columns\TextColumn::make('created_at')->dateTime()->label('Dibuat pada')->sortable(),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
                Tables\Actions\ViewAction::make(),

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
            'index' => Pages\ListPosts::route('/'),
            'create' => Pages\CreatePost::route('/create'),
            'edit' => Pages\EditPost::route('/{record}/edit'),
        ];
    }
}
