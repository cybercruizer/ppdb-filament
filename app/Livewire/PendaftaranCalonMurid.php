<?php

namespace App\Livewire;

use App\Models\CalonMurid;
use App\Models\MuridAktif;
use Illuminate\Validation\Rule;
use Livewire\Component;
use Livewire\WithFileUploads;

class PendaftaranCalonMurid extends Component
{
    use WithFileUploads;

    // ===== Step 1: cek NIK =====
    public string $nik = '';
    public bool $nikSudahDicek = false;
    public bool $nikSudahAda = false;

    // ===== Step 2: form data calon murid =====
    public string $nama = '';
    public string $asal_smp = '';
    public string $alamat = '';
    public string $nama_ortu = '';
    public string $no_wa = '';
    public $scan_kk;

    // ===== Pencarian murid pendamping (murid aktif) =====
    public string $carianPendamping = '';
    public ?int $pendamping_id = null;
    public string $pendamping_nama = '';

    // ===== Captcha sederhana (penjumlahan) =====
    public int $captchaA = 0;
    public int $captchaB = 0;
    public $captchaJawaban = '';

    // ===== Status hasil submit =====
    public ?bool $suksesSubmit = null;
    public string $pesanSubmit = '';

    public function mount(): void
    {
        $this->buatCaptcha();
    }

    protected function buatCaptcha(): void
    {
        $this->captchaA = rand(1, 10);
        $this->captchaB = rand(1, 10);
        $this->captchaJawaban = '';
    }

    /**
     * Hasil pencarian murid pendamping, dihitung ulang otomatis
     * setiap kali properti $carianPendamping berubah (reactive search).
     */
    public function getHasilPendampingProperty()
    {
        if (mb_strlen(trim($this->carianPendamping)) < 2) {
            return collect();
        }

        return MuridAktif::query()
//            ->with('kelas')
            ->where('nama', 'like', '%' . $this->carianPendamping . '%')
            ->orderBy('nama')
            ->limit(8)
            ->get();
    }

    public function pilihPendamping(int $id): void
    {
        $murid = MuridAktif::find($id);

        if ($murid) {
            $this->pendamping_id = $murid->id;
            $this->pendamping_nama = $murid->nama . ' — ' . $murid->kelas;
            $this->carianPendamping = '';
        }
    }

    public function batalPendamping(): void
    {
        $this->pendamping_id = null;
        $this->pendamping_nama = '';
    }

    /**
     * Tombol "Periksa" pada step 1.
     */
    public function periksaNik(): void
    {
        $this->resetErrorBag();
        $this->suksesSubmit = null;

        $this->validate([
            'nik' => ['required', 'digits:16'],
        ], [
            'nik.required' => 'NIK wajib diisi.',
            'nik.digits' => 'NIK harus terdiri dari 16 digit angka.',
        ]);

        $this->nikSudahDicek = true;
        $this->nikSudahAda = CalonMurid::where('nik', $this->nik)->exists();
    }

    public function ubahNik(): void
    {
        $this->reset([
            'nikSudahDicek', 'nikSudahAda', 'suksesSubmit', 'pesanSubmit',
        ]);
    }

    protected function rules(): array
    {
        return [
            'nik' => ['required', 'digits:16', Rule::unique('calon_murids', 'nik')],
            'nama' => ['required', 'string', 'max:255'],
            'asal_smp' => ['required', 'string', 'max:255'],
            'alamat' => ['required', 'string', 'max:1000'],
            'nama_ortu' => ['required', 'string', 'max:255'],
            'no_wa' => ['required', 'string', 'max:20'],
            'scan_kk' => ['required', 'image', 'max:4096'],
            'pendamping_id' => ['required', 'exists:murid_aktifs,id'],
            'captchaJawaban' => ['required', 'numeric'],
        ];
    }

    protected function messages(): array
    {
        return [
            'nik.unique' => 'NIK sudah ada di sistem.',
            'scan_kk.required' => 'Scan Kartu Keluarga wajib diunggah.',
            'scan_kk.image' => 'File harus berupa gambar (JPG/PNG).',
            'scan_kk.max' => 'Ukuran file maksimal 4MB.',
            'pendamping_id.required' => 'Silakan pilih murid pendamping.',
            'captchaJawaban.required' => 'Silakan isi captcha.',
            'captchaJawaban.numeric' => 'Jawaban captcha harus berupa angka.',
        ];
    }

    public function submit(): void
    {
        $this->suksesSubmit = null;

        $this->validate();

        if ((int) $this->captchaJawaban !== ($this->captchaA + $this->captchaB)) {
            $this->addError('captchaJawaban', 'Jawaban captcha salah, silakan coba lagi.');
            $this->buatCaptcha();

            return;
        }

        try {
            $path = $this->scan_kk->store('scan-kk', 'public');

            CalonMurid::create([
                'nik' => $this->nik,
                'nama' => $this->nama,
                'asal_smp' => $this->asal_smp,
                'alamat' => $this->alamat,
                'nama_ortu' => $this->nama_ortu,
                'no_wa' => $this->no_wa,
                'scan_kk' => $path,
                'murid_pendamping_id' => $this->pendamping_id,
            ]);

            $this->suksesSubmit = true;
            $this->pesanSubmit = 'Data calon murid berhasil disimpan. Terima kasih telah mendaftar.';
            $this->resetForm();
        } catch (\Throwable $e) {
            report($e);
            $this->suksesSubmit = false;
            $this->pesanSubmit = 'Gagal menyimpan data. Silakan periksa kembali isian Anda dan coba lagi.';
            $this->buatCaptcha();
        }
    }

    protected function resetForm(): void
    {
        $this->reset([
            'nik', 'nama', 'asal_smp', 'alamat', 'nama_ortu', 'no_wa',
            'scan_kk', 'pendamping_id', 'pendamping_nama', 'carianPendamping',
            'nikSudahDicek', 'nikSudahAda', 'captchaJawaban',
        ]);
        $this->buatCaptcha();
    }

    public function render()
    {
        return view('livewire.pendaftaran-calon-murid')->layout('components.layouts.app-pendaftaran');;
    }
}