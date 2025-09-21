<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
use App\Models\Tagihan;
use Filament\Forms\Get;
use Filament\Forms\Form;
use App\Models\Pembayaran;
use Filament\Tables\Table;
use Filament\Support\RawJs;
use Filament\Resources\Resource;
use Filament\Tables\Filters\Layout;
use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\Select;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\DatePicker;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\PembayaranResource\Pages;
use App\Filament\Resources\PembayaranResource\RelationManagers;
use Filament\Tables\Actions\Action;

class PembayaranResource extends Resource
{
    protected static ?string $model = Pembayaran::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';
    protected static ?string $navigationGroup = 'Data Keuangan';
    //change the url to pembayaran
    protected static ?string $slug = 'pembayaran';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Select::make('tagihan_id')
                    ->label('Tagihan Siswa')
                    ->options(
                        Tagihan::with('siswa')->get()->mapWithKeys(function ($t) {
                            return [$t->id => $t->siswa->nama . ' - ' . number_format($t->jumlah_tagihan)];
                        })
                    )
                    ->searchable()
                    ->live()
                    ->reactive()
                    ->afterStateUpdated(function (callable $set, $state) {
                        $tagihan = Tagihan::find($state);
                        if ($tagihan) {
                            $set('sisa_tagihan', number_format($tagihan->jumlah_tagihan - $tagihan->pembayarans->sum('jumlah_pembayaran')));
                            $set('siswa_id', $tagihan->siswa_id);
                        } else {
                            $set('sisa_tagihan', 0);
                        }
                    })
                    ->required(),
                Hidden::make('siswa_id')
                    ->label('Siswa')
                    ->dehydrated()
                    ->required(),
                TextInput::make('sisa_tagihan')
                    ->label('Sisa Tagihan')
                    ->disabled(),

                TextInput::make('jumlah_pembayaran')
                    ->label('Nominal Pembayaran')
                    ->numeric()
                    ->mask(RawJs::make('$money($input)'))
                    ->stripCharacters(',')
                    ->required()
                    ->rule(function ($get) {
                        return function ($attribute, $value, $fail) use ($get) {
                            $tagihan = Tagihan::with('pembayarans')->find($get('tagihan_id'));
                            if (!$tagihan) return;
                            $sisa = $tagihan->jumlah_tagihan - $tagihan->pembayarans->sum('jumlah_pembayaran');
                            if ($value > $sisa) {
                                $fail("Nominal Terlalu besar, sisa tagihan: Rp " . number_format($sisa));
                            }
                        };
                    }),

                DatePicker::make('tanggal_pembayaran')
                    ->label('Tanggal Pembayaran')
                    ->required()
                    ->default(now())
                    ->required(),
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
                TextColumn::make('siswa.nomor_pendaftaran')
                    ->label('Nama Siswa')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('tagihan.jumlah_tagihan')
                    ->label('Jumlah Tagihan')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('jumlah_pembayaran')
                    ->label('Jumlah Pembayaran')
                    ->money('IDR')
                    ->sortable(),
                TextColumn::make('tanggal_pembayaran') //
                    ->date('d/m/Y')
                    ->label('Tanggal Pembayaran')
                    ->sortable(),
            ])
            ->filters([
                //make date range filter
                Tables\Filters\Filter::make('tanggal_pembayaran')
                    ->form([
                        Forms\Components\DatePicker::make('start_date')
                            ->label('Start Date')
                            ->default(now()->startOfYear()),
                        Forms\Components\DatePicker::make('end_date')
                            ->label('End Date')
                            ->default(now()->endOfYear()),
                    ])
                    ->query(function (Builder $query, array $data) {
                        if (!empty($data['start_date']) && !empty($data['end_date'])) {
                            return $query->whereBetween('tanggal_pembayaran', [
                                $data['start_date'],
                                $data['end_date'],
                            ]);
                        }
                        return $query;
                    })
                    ->default([
                        'start_date' => now()->startOfYear()->toDateString(),
                        'end_date' => now()->endOfYear()->toDateString(),
                    ]),

            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
                // Print Receipt Action
                Action::make('print_kwitansi')
                    ->label('Print Kwitansi')
                    ->icon('heroicon-o-printer')
                    ->color('success')
                    ->url(fn(Pembayaran $record): string => route('kwitansi.print', $record))
                    ->openUrlInNewTab(),

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
            'index' => Pages\ManagePembayarans::route('/'),
        ];
    }
}
