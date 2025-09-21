<?php

namespace App\Filament\Resources;

use Dom\Text;
use Filament\Forms;
use Filament\Tables;
use App\Models\Tagihan;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Filament\Resources\Resource;
use Filament\Tables\Columns\TextColumn;
use App\Filament\Exports\TagihanExporter;
use Filament\Tables\Actions\ExportAction;
use Illuminate\Database\Eloquent\Builder;
use Filament\Tables\Columns\Summarizers\Sum;
use Filament\Actions\Exports\Enums\ExportFormat;
use App\Filament\Resources\TagihanResource\Pages;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\TagihanResource\RelationManagers;

class TagihanResource extends Resource
{
    protected static ?string $model = Tagihan::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';
    protected static ?string $slug = 'tagihan';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('siswa.nama')
                    ->label('Nama Siswa')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('jumlah_tagihan')
                    ->label('Jumlah Tagihan')
                    ->money('IDR')
                    ->sortable(),
                TextColumn::make('pembayarans.jumlah_pembayaran')
                    ->label('Jumlah Pembayaran')
                    ->money('IDR')
                    ->getStateUsing(fn ($record) => $record->pembayarans->sum('jumlah_pembayaran')),
                TextColumn::make('Lunas')
                    ->label('Status')
                    ->getStateUsing(function ($record) {
                        return $record->pembayarans->sum('jumlah_pembayaran') >= $record->jumlah_tagihan ? 'Lunas' : 'Belum Lunas';
                    })
                    ->badge()
                    ->color(fn ($state) => $state === 'Lunas' ? 'success' : 'danger'),
            ])
            ->filters([
                //make filter for gelombang
                Tables\Filters\SelectFilter::make('gelombang')
                    ->relationship('siswa.gelombang', 'nama_gelombang')
                    ->placeholder('Semua Gelombang')
                    ->columnSpan([
                        'sm' => 2,
                        'lg' => 3,
                    ])
                    ->default(null),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),

            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ])
            ->headerActions([
                ExportAction::make()
                    ->exporter(TagihanExporter::class)
                    ->formats([
                        ExportFormat::Xlsx,
                    ])
                    ->icon('heroicon-o-arrow-down-tray')
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
            'index' => Pages\ListTagihans::route('/'),
            'create' => Pages\CreateTagihan::route('/create'),
            //'edit' => Pages\EditTagihan::route('/{record}/edit'),
        ];
    }
}
