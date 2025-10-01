<?php

namespace App\Livewire;

use App\Models\Siswa;
use App\Models\Tahun;
use App\Models\Jurusan;
use App\Models\Tagihan;
use Livewire\Component;
use Filament\Forms\Form;
use App\Models\Gelombang;
use App\Models\PengaturanWebsite;
use Illuminate\Contracts\View\View;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Section;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Notifications\Notification;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Placeholder;
use Filament\Forms\Components\MarkdownEditor;
use Filament\Forms\Concerns\InteractsWithForms;
use MarcoGermani87\FilamentCaptcha\Forms\Components\CaptchaField;

class CreatePendaftar extends Component implements HasForms
{
    use InteractsWithForms;

    public ?array $data = [];

    public function mount(): void
    {
        $this->form->fill();
    }

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                // Section::make('Informasi Pendaftaran')
                //     ->schema([
                //         Placeholder::make('info')
                //             ->content('Silakan isi formulir pendaftaran dengan data yang benar dan lengkap.')
                //             ->columnSpanFull(),
                //     ]),
                Section::make('Pilihan Program')
                    ->schema([
                        Select::make('tahun_id')
                            ->label('Tahun Ajaran')
                            ->options(Tahun::where('is_active', true)->pluck('nama_tahun', 'id'))
                            ->required(),

                        Select::make('jurusan_id')
                            ->label('Jurusan')
                            ->options(Jurusan::select('id', 'nama_jurusan', 'kode_jurusan')->pluck('nama_jurusan', 'id'))
                            ->required()
                            ->reactive(),
                            // ->afterStateUpdated(function ($state, callable $set, callable $get) {
                            //     $jurusan = Jurusan::find($state);
                            //     $gelombangId = $get('gelombang_id');
                            //     $gelombang = $gelombangId ? Gelombang::find($gelombangId) : null;
                            //     if ($jurusan && $gelombang) {
                            //         $kode = $jurusan->kode_jurusan . '-' . $gelombang->kode_gelombang;
                            //         $set('nomor_pendaftaran', $kode);
                            //     }
                            // }),

                        Select::make('gelombang_id')
                            ->label('Gelombang')
                            ->options(Gelombang::where('is_active', true)->pluck('nama_gelombang', 'id'))
                            ->required(),
                            // ->reactive()
                            // ->afterStateUpdated(function ($state, callable $set, callable $get) {
                            //     $gelombang = Gelombang::find($state);
                            //     $jurusanId = $get('jurusan_id');
                            //     $jurusan = $jurusanId ? Jurusan::find($jurusanId) : null;
                            //     if ($jurusan && $gelombang) {
                            //         $kode = $jurusan->kode_jurusan . '-' . $gelombang->kode_gelombang;
                            //         $set('nomor_pendaftaran', $kode);
                            //     }
                            // }),
                        Select::make('kategori')
                            ->options([
                                'REG' => 'Reguler',
                                // 'AP50' => 'AP 50%',
                                // 'AP100' => 'AP 100%',
                                // 'KB' => 'Kakak Beradik',
                                // 'KM' => 'Kembar',
                                // 'AUM' => 'Pegawai AUM',
                                // 'PDK' => 'Pondok'
                            ])
                            ->required()
                            ->label('Kategori'),
                    ])
                    ->columns(2),

                Section::make('Data Pribadi')
                    ->schema([
                        TextInput::make('nomor_pendaftaran')
                            ->label('Nomor Pendaftaran (akan terisi otomatis)')
                            ->disabled()
                            ->dehydrated(true)
                            ->afterStateHydrated(function ($state, $set, $get) {
                                if (!$state && $get('jurusan_id') && $get('gelombang_id') && $get('kategori')) {
                                    $set('nomor_pendaftaran', Siswa::generateNomor(
                                        $get('jurusan_id'),
                                        $get('gelombang_id'),
                                        $get('kategori'),
                                    ));
                                }
                            }),

                        TextInput::make('nama')
                            ->label('Nama Lengkap')
                            ->required()
                            ->maxLength(255),
                        TextInput::make('asal_sekolah')
                            ->label('Asal Sekolah/SMP/MTs')
                            ->required()
                            ->maxLength(255),
                        TextInput::make('tempat_lahir')
                            ->label('Tempat Lahir')
                            ->required()
                            ->maxLength(100),

                        DatePicker::make('tanggal_lahir')
                            ->label('Tanggal Lahir')
                            ->required()
                            ->maxDate(now()),

                        Select::make('jenis_kelamin')
                            ->label('Jenis Kelamin')
                            ->options([
                                'L' => 'Laki-laki',
                                'P' => 'Perempuan',
                            ])
                            ->required(),

                        TextInput::make('no_telepon')
                            ->label('No. Telepon/HP calon murid')
                            ->tel()
                            ->required()
                            ->maxLength(15),
                        Textarea::make('alamat')
                            ->label('Alamat Lengkap calon murid')
                            ->required()
                            ->columnSpanFull(),
                    ])
                    ->columns(2),

                Section::make('Data Orang Tua')
                    ->schema([


                        TextInput::make('nama_ayah')
                            ->label('Nama Ayah')
                            ->required()
                            ->maxLength(255),

                        TextInput::make('nama_ibu')
                            ->label('Nama Ibu')
                            ->required()
                            ->maxLength(255),

                        TextInput::make('no_telepon_ortu')
                            ->label('No. Telepon/HP Orang Tua/Wali')
                            ->tel()
                            ->required()
                            ->maxLength(15),
                        TextArea::make('alamat_ortu')
                            ->label('Alamat Orang Tua/Wali')
                            ->columnSpanFull()
                            ->maxLength(255),
                    ])
                    ->columns(2),

                Section::make('Informasi Tambahan')
                    ->schema([
                        Textarea::make('catatan')
                            ->label('Catatan Tambahan')
                            ->columnSpanFull(),
                        Select::make('informasi')
                            ->label('Informasi tentang PPDB')
                            ->options([
                                'MS' => 'Media Sosial',
                                'TM' => 'Teman',
                                'TT' => 'Tetangga',
                                'GR' => 'Guru',
                                'SK' => 'Sekolah',
                            ])
                            ->required()
                            ->placeholder('Pilih Sumber Informasi'),
                    ]),
                Section::make('Kode Pengaman')
                    ->schema([
                        CaptchaField::make('captcha')
                            ->label('Silakan isi kode pengaman ini untuk melanjutkan.')
                            ->required(),
                    ])->columns(2),
            ])
            ->statePath('data');
    }

    public function create(): void
    {
        $data = $this->form->getState();
        //dd($data);


        $pendaftaran = Siswa::create($data);
        $penambahan_biaya_putri = PengaturanWebsite::where('key', 'penambahan_biaya_putri')->value('value');
        if ($pendaftaran->jenis_kelamin == 'L') {
            $du = Gelombang::find($data['gelombang_id'])->biaya;
        } else {
            $du = Gelombang::find($data['gelombang_id'])->biaya + $penambahan_biaya_putri;
        }
        //input to tagihan
        Tagihan::create([
            'siswa_id' => $pendaftaran->id,
            'nama_tagihan' => 'PPDB',
            'jumlah_tagihan' => $du,
        ]);

        Notification::make()
            ->title('Pendaftaran Berhasil!')
            ->body('Nomor pendaftaran Anda: ' . $pendaftaran->nomor_pendaftaran.' Silakan catat nomor pendaftaran Anda untuk keperluan selanjutnya.')
            ->success()
            ->persistent()
            ->send();

        $this->form->fill();

        session()->flash('success', 'Pendaftaran berhasil! Nomor pendaftaran: ' . $pendaftaran->nomor_pendaftaran).' Silakan catat nomor pendaftaran Anda untuk keperluan selanjutnya.';
    }

    public function render(): View
    {
        return view('livewire.create-pendaftar');
    }
}
