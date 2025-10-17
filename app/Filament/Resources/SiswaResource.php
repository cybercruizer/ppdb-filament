<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
use App\Models\Siswa;
use App\Models\Tahun;
use Filament\Forms\Form;
use App\Models\Gelombang;
use Filament\Tables\Table;
use Filament\Support\RawJs;
use Filament\Infolists\Infolist;
use Filament\Resources\Resource;
use Filament\Actions\ActionGroup;
use Filament\Forms\Components\Toggle;
use App\Filament\Exports\SiswaExporter;
use Filament\Forms\Components\Tabs\Tab;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Actions\CreateAction;
use Filament\Tables\Actions\ExportAction;
use Illuminate\Database\Eloquent\Builder;
use Filament\Infolists\Components\Section;
use Filament\Infolists\Components\IconEntry;
use Filament\Infolists\Components\TextEntry;
use App\Filament\Resources\SiswaResource\Pages;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\SiswaResource\RelationManagers;

class SiswaResource extends Resource
{
    protected static ?string $model = Siswa::class;

    protected static ?string $navigationIcon = 'heroicon-o-user-group';
    protected static ?string $navigationGroup = 'PPDB';
    protected static ?string $navigationLabel = 'Pendaftar';
    protected static ?string $label = 'Pendaftar';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('jurusan_id')
                    ->relationship('jurusan', 'nama_jurusan')
                    ->required()
                    ->label('Jurusan'),
                Forms\Components\Select::make('gelombang_id')
                    ->relationship('gelombang', 'nama_gelombang')
                    ->required()
                    ->label('Gelombang'),
                Forms\Components\TextInput::make('nomor_pendaftaran')
                    ->required()
                    ->maxLength(17)
                    ->unique(ignoreRecord: true)
                    ->label('Nomor Pendaftaran'),
                Forms\Components\Select::make('kategori')
                    ->options([
                        'REG' => 'Reguler',
                        'AP50' => 'AP 50%',
                        'AP100' => 'AP 100%',
                        'KB' => 'Kakak Beradik',
                        'KM' => 'Kembar',
                        'AUM' => 'Pegawai AUM',
                        'PDK' => 'Pondok'
                    ])
                    ->required()
                    ->label('Kategori'),
                Forms\Components\TextInput::make('nama')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('tempat_lahir')
                    ->required()
                    ->maxLength(255),
                Forms\Components\DatePicker::make('tanggal_lahir')
                    ->required()
                    ->label('Tanggal Lahir')
                    ->placeholder('Pilih Tanggal Lahir'),
                Forms\Components\Select::make('jenis_kelamin')
                    ->options([
                        'L' => 'Laki-laki',
                        'P' => 'Perempuan',
                    ])
                    ->required()
                    ->label('Jenis Kelamin'),
                Forms\Components\Textarea::make('alamat')
                    ->required()
                    ->rows(3)
                    ->maxLength(255)
                    ->label('Alamat'),
                Forms\Components\TextInput::make('no_telepon')
                    ->maxLength(15)
                    ->tel()
                    ->label('Nomor Telepon'),
                Forms\Components\TextInput::make('asal_sekolah')
                    ->required()
                    ->maxLength(255)
                    ->label('Asal Sekolah'),
                Forms\Components\Fieldset::make('Data Orang Tua')
                    ->schema([
                        Forms\Components\TextInput::make('nama_ayah')
                            ->required()
                            ->maxLength(255)
                            ->label('Nama Ayah'),
                        Forms\Components\TextInput::make('nama_ibu')
                            ->required()
                            ->maxLength(255)
                            ->label('Nama Ibu'),
                    ]),

                Forms\Components\Hidden::make('tahun_id')
                    ->required()
                    ->default(function (callable $get) {
                        return Tahun::where('is_active', true)
                            ->first()->id;
                    }),
                //create tagihan for this siswa, jumlah_tagihan = gelombang.biaya where is_active = true
                /*                Forms\Components\TextInput::make('jumlah_tagihan')
                    ->required()
                    ->numeric()
                    ->label('Jumlah Tagihan')
                    ->placeholder('Masukkan Jumlah Tagihan')
                    ->default(function (callable $get) {
                        return Gelombang::where('is_active', true)
                            ->first()->biaya;
                    }),
*/
                Forms\Components\Fieldset::make('Tagihan')
                    ->relationship('tagihan')
                    ->schema([
                        Forms\Components\TextInput::make('nama_tagihan')
                            ->required()
                            ->label('Nama Tagihan')
                            ->default('PPDB25'),
                        Forms\Components\TextInput::make('jumlah_tagihan')
                            ->required()
                            ->prefix('Rp')
                            ->mask(RawJs::make('$money($input)'))
                            ->stripCharacters(',')
                            ->label('Jumlah Tagihan')
                            ->placeholder('Masukkan Jumlah Tagihan')
                            ->default(function (callable $get) {
                                return Gelombang::where('is_active', true)
                                    ->first()->biaya;
                            }),
                    ]),
                Forms\Components\TextInput::make('catatan')
                    ->maxLength(255)
                    ->label('Catatan'),

            ]);
    }

    //add infolist to table
    public static function infolist(Infolist $infolist): Infolist
    {
        return $infolist
            ->schema([
                Section::make('Biodata')
                    ->schema([
                        TextEntry::make('nomor_pendaftaran')
                            ->label('Nomor Pendaftaran'),
                        TextEntry::make('nama')
                            ->label('Nama Lengkap'),
                        TextEntry::make('tempat_lahir')
                            ->label('Tempat Lahir'),
                        TextEntry::make('tanggal_lahir')
                            ->label('Tanggal Lahir')
                            ->date('d-m-Y'),
                        TextEntry::make('jenis_kelamin')
                            ->label('Jenis Kelamin'),
                        TextEntry::make('alamat')
                            ->label('Alamat'),
                        TextEntry::make('no_telepon')
                            ->label('Nomor Telepon'),
                        TextEntry::make('asal_sekolah')
                            ->label('Asal Sekolah'),
                    ])
                    ->columns(2),
                Section::make('Lain-lain')
                    ->schema([
                        TextEntry::make('kategori')
                            ->label('Kategori'),
                        TextEntry::make('jurusan.nama_jurusan')
                            ->label('Jurusan'),
                        TextEntry::make('gelombang.nama_gelombang')
                            ->label('Gelombang'),
                        TextEntry::make('tahun.nama_tahun')
                            ->label('Tahun Ajaran'),
                        TextEntry::make('is_accepted')
                            ->label('Diterima'),
                        TextEntry::make('catatan')
                            ->label('Catatan'),
                    ])
                    ->columns(2),
                Section::make('Orang Tua')
                    ->schema([
                        TextEntry::make('nama_ayah')
                            ->label('Nama Ayah'),
                        TextEntry::make('nama_ibu')
                            ->label('Nama Ibu'),
                    ])
                    ->columns(2),
                Section::make('Tes Fisik')
                    ->schema([
                        TextEntry::make('tesfisik.berat')
                            ->label('Berat Badan (kg)'),
                        TextEntry::make('tesfisik.tinggi')
                            ->label('Tinggi Badan (cm)'),
                        TextEntry::make('tesfisik.mata')
                            ->label('Mata')
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
                        TextEntry::make('tesfisik.telinga')
                            ->label('Telinga')
                            ->formatStateUsing(function ($state) {
                                return match ($state) {
                                    'N' => 'Normal',
                                    'KNK' => 'Kurang Normal Kiri',
                                    'KRK' => 'Kurang Normal Kanan',
                                    default => $state,
                                };
                            }),
                        IconEntry::make('tesfisik.obat')
                            ->label('Ketergantungan obat')
                            ->boolean()
                            ->trueIcon('heroicon-o-check-circle')
                            ->falseIcon('heroicon-o-x-circle')
                            ->trueColor('success')
                            ->falseColor('danger'),
                        TextEntry::make('tesfisik.penyakit')
                            ->label('Penyakit yang pernah diderita'),
                        TextEntry::make('tesfisik.tato')
                            ->label('Tato dan tindik')
                            ->formatStateUsing(function ($state) {
                                return match ($state) {
                                    'N' => 'Tidak Ada',
                                    'TA' => 'Tato Ada',
                                    'TI' => 'Tindik',
                                    default => $state,
                                };
                            }),
                        TextEntry::make('tesfisik.disabilitas')
                            ->label('Disabilitas')
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
                        TextEntry::make('tesfisik.ibadah')
                            ->label('Ibadah')
                            ->formatStateUsing(function ($state) {
                                return match ($state) {
                                    'B' => 'Baik',
                                    'C' => 'Cukup',
                                    'K' => 'Kurang',
                                    default => $state,
                                };
                            }),
                        TextEntry::make('tesfisik.alquran')
                            ->label('Membaca Al-Quran')
                            ->formatStateUsing(function ($state) {
                                return match ($state) {
                                    'S' => 'Sangat Baik',
                                    'B' => 'Baik',
                                    'T' => 'Tidak Bisa',
                                    default => $state,
                                };
                        }),
                        TextEntry::make('tesfisik.membaca')
                            ->label('Membaca teks')
                            ->formatStateUsing(function ($state) {
                                return match ($state) {
                                    'L' => 'Lancar',
                                    'KL' => 'Kurang Lancar',
                                    'TB' => 'Tidak Bisa',
                                    default => $state,
                                };
                            }),
                        TextEntry::make('tesfisik.ukuran_baju')
                            ->label('Ukuran baju'),
                    ])
                    ->columns(2)
                    ->visible(fn(Siswa $record):bool=>$record->sudahtesfisik),
                Section::make('prestasi')
                    ->schema([
                        TextEntry::make('tesfisik.akademik')
                            ->label('Prestasi akademik'),
                        TextEntry::make('tesfisik.non_akademik')
                            ->label('Prestasi non akademik'),
                    ])->columns(2)
                    ->visible(fn(Siswa $record):bool=>$record->sudahtesfisik),
                
                Section::make('Tagihan Daftar Ulang')
                    ->schema([
                        // TextEntry::make('tagihan.nama_tagihan')
                        //     ->label('Nama Tagihan'),
                        TextEntry::make('tagihan.jumlah_tagihan')
                            ->label('Jumlah Tagihan')
                            ->money('IDR'),
                        TextEntry::make('tagihan.terbayar')
                            ->label('Terbayar')
                            ->money('IDR'),
                        TextEntry::make('tagihan.status')
                            ->label('Status')
                    ])
                    ->columns(3),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('No')
                    ->rowIndex(),
                Tables\Columns\TextColumn::make('nomor_pendaftaran')
                    ->sortable()
                    ->searchable()
                    ->label('Nomor Pendaftaran'),
                Tables\Columns\TextColumn::make('nama')
                    ->sortable()
                    ->searchable()
                    //limit string to 50 character
                    ->limit(30)
                    ->description(fn(Siswa $record): string => substr($record->catatan,0,40) ?? ''),
                Tables\Columns\TextColumn::make('tempat_lahir')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('tanggal_lahir')
                    ->label('Tgl Lahir')
                    ->date('d-m-Y')
                    ->sortable(),
                Tables\Columns\TextColumn::make('jenis_kelamin')
                    ->sortable()
                    ->label('JK'),
                Tables\Columns\TextColumn::make('asal_sekolah')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('jurusan.kode_jurusan')
                    ->sortable()
                    ->label('Jur'),
                IconColumn::make('sudahtesfisik')
                    ->boolean()
                    ->label('Tes Fsk')
                    ->trueIcon('heroicon-o-check-circle')
                    ->falseIcon('heroicon-o-x-circle')
                    ->trueColor('success')
                    ->falseColor('danger'),
                IconColumn::make('sudahdu')
                    ->boolean()
                    ->label('DU')
                    ->trueIcon('heroicon-o-check-circle')
                    ->falseIcon('heroicon-o-x-circle')
                    ->trueColor('success')
                    ->falseColor('danger'),
                Tables\Columns\ToggleColumn::make('is_accepted')
                    ->label('diterima')
                    ->onIcon('heroicon-s-check-circle')
                    ->offIcon('heroicon-s-x-circle')
                    ->onColor('success')
                    ->offColor('danger'),
                Tables\Columns\TextColumn::make('created_at')
                    //make format date to d-m-Y
                    ->date('d-m-Y')
                    //->dateTime()
                    ->sortable()
                    ->label('Tgl Input'),
                //

            ])
            ->filters([
                //make filter based on gelombang_id
                Tables\Filters\SelectFilter::make('gelombang_id')
                    ->relationship('gelombang', 'nama_gelombang')
                    ->label('Gelombang'),
            ])
            ->actions([
                Tables\Actions\ActionGroup::make([
                    Tables\Actions\EditAction::make(),
                    Tables\Actions\DeleteAction::make(),
                    Tables\Actions\Action::make('waAction')
                        ->label('WA')
                        ->url(fn(Siswa $record): string => 'https://api.whatsapp.com/send?phone=62' . substr($record->no_telepon, 1) . '&text=Hallo%20' . $record->nama . '%0A%0AAssalamualaikum%20wr%20wb%0A%0AKami%20TIM%20PPDB%20SMK%20Muhammadiyah%20Mungkid%0A')
                        ->icon('heroicon-o-paper-airplane')
                        ->openUrlInNewTab()
                        ->color('success'),
                    Tables\Actions\Action::make('print')
                        ->url(fn(Siswa $record): string => route('pengumuman.print', ['id' => $record->id]))
                        ->icon('heroicon-o-printer')
                        ->openUrlInNewTab()
                        ->color('primary'),
                    Tables\Actions\ViewAction::make(),
                ])
            ])
            ->headerActions([
                CreateAction::make()
                    ->icon('heroicon-o-plus'),
                ExportAction::make()
                    ->exporter(SiswaExporter::class)
                    ->columnMapping(false)
                    ->icon('heroicon-o-arrow-down-tray')
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ])
            ->defaultSort('created_at', 'desc')
            ->recordAction('view')
            ->recordUrl(null);
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
            'index' => Pages\ListSiswas::route('/'),
            'create' => Pages\CreateSiswa::route('/create'),
            'view' => Pages\ViewSiswa::route('/{record}'),
            'edit' => Pages\EditSiswa::route('/{record}/edit'),
        ];
    }
}
