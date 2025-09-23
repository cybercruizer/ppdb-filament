<?php

namespace App\Livewire;

use App\Models\Siswa;
use App\Models\Tahun;
use App\Models\Jurusan;
use App\Models\Tagihan;
use Livewire\Component;
use App\Models\Tesfisik;
use Filament\Forms\Form;
use App\Models\Gelombang;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth;
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

class CreateTesfisik extends Component implements HasForms
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
            Section::make('Data Calon Siswa')
                ->schema([
                    Select::make('siswa_id')
                        ->label('Calon Siswa')
                        ->options(Siswa::pluck('nama', 'id'))
                        ->required()
                        ->searchable()
                        ->reactive()
                        ->afterStateUpdated(function ($state, callable $set) {
                            $siswa = Siswa::find($state);
                            if ($siswa) {
                                $set('nomor_pendaftaran', $siswa->nomor_pendaftaran);
                            } else {
                                $set('nomor_pendaftaran', null);
                            }
                        }),
                    TextInput::make('nomor_pendaftaran')
                        ->label('Nomor Pendaftaran')
                        ->disabled(),
                    ]),    
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
                CaptchaField::make('captcha'),
            ])
            ->statePath('data');
    }

    public function create(): void
    {
        $data = $this->form->getState();
        //dd($data);
        // $data['user_id'] = Auth::user()->id;

        $tesfisik = Tesfisik::create($data);
        //input to tagihan

        Notification::make()
            ->title('Tes Fisik Berhasil!')
            ->body('Bisa cetak pengumuman')
            ->success()
            ->persistent()
            ->send();

        $this->form->fill();

        session()->flash('success', 'Input TEs FIsik Berhasil');
    }

    public function render(): View
    {
        return view('livewire.create-tesfisik');
    }
}