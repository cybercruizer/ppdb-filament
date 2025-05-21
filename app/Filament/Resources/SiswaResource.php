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
use Filament\Resources\Resource;
use Illuminate\Database\Eloquent\Builder;
use App\Filament\Resources\SiswaResource\Pages;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\SiswaResource\RelationManagers;
use Filament\Forms\Components\Tabs\Tab;

class SiswaResource extends Resource
{
    protected static ?string $model = Siswa::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';
    //protected static ?string $navigationGroup = 'Data Dasar';
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
                    ->maxLength(10)
                    ->unique(ignoreRecord: true)
                    ->label('Nomor Pendaftaran'),
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

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('id')
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('nomor_pendaftaran')
                    ->sortable()
                    ->searchable()
                    ->label('Nomor Pendaftaran'),
                Tables\Columns\TextColumn::make('nama')
                    ->sortable()
                    ->searchable()
                    //limit string to 50 character
                    ->limit(30)
                    ->description(fn (Siswa $record): string => $record->catatan),
                Tables\Columns\TextColumn::make('tempat_lahir')
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('tanggal_lahir')
                    ->date('d-m-Y')
                    ->sortable(),
                Tables\Columns\TextColumn::make('jenis_kelamin')
                    ->sortable()
                    ->searchable()
                    ->label('JK'),
                Tables\Columns\TextColumn::make('asal_sekolah')
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('jurusan.kode_jurusan')
                    ->sortable()
                    ->searchable()
                    ->label('Jurusan'),
                Tables\Columns\TextColumn::make('namaTahun')
                    ->sortable()
                    ->searchable()
                    ->label('Tahun Ajaran'),
                Tables\Columns\TextColumn::make('created_at')
                    //make format date to d-m-Y
                    ->date('d-m-Y')
                    //->dateTime()
                    ->sortable()
                    ->label('Tgl Input'),
                //

            ])
            ->filters([
                //make filter based on jurusan_id
                Tables\Filters\SelectFilter::make('jurusan_id')
                    ->relationship('jurusan', 'nama_jurusan')
                    ->label('Jurusan'),
                //make filter based on gelombang_id
                Tables\Filters\SelectFilter::make('gelombang_id')
                    ->relationship('gelombang', 'nama_gelombang')
                    ->label('Gelombang'),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
                Tables\Actions\Action::make('waAction')
                    ->label('WA')
                    ->url(fn (Siswa $record): string => 'https://api.whatsapp.com/send?phone=62' . substr($record->no_telepon, 1) . '&text=Hallo%20' . $record->nama . '%0A%0AAssalamualaikum%20wr%20wb%0A%0AKami%20TIM%20PPDB%20SMK%20Muhammadiyah%20Mungkid%0A')
                    ->icon('heroicon-o-paper-airplane')
                    ->openUrlInNewTab()
                    ->color('success'),

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
            'index' => Pages\ListSiswas::route('/'),
            'create' => Pages\CreateSiswa::route('/create'),
            'edit' => Pages\EditSiswa::route('/{record}/edit'),
        ];
    }
}
