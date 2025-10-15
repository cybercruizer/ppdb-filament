<?php

use App\Models\Siswa;
use App\Models\Tagihan;
use App\Livewire\CreateTesfisik;
use App\Livewire\CreatePendaftar;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\JurusanController;
use App\Http\Controllers\KwitansiController;
use App\Http\Controllers\VerifikasiController;
use App\Filament\Resources\PendaftaranResource\Pages\CreatePendaftaran;
use App\Models\Gelombang;
use App\Models\PengaturanWebsite;
use App\Models\Tahun;

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/informasi',[HomeController::class, 'informasi'])->name('berita');
Route::get('/jurusan/{kode_jurusan}',[JurusanController::class,'deskripsi'])->name('jurusan');
Route::get('form-pendaftaran', [HomeController::class, 'form'])->name('form.pendaftaran');
Route::post('form-pendaftaran', [HomeController::class, 'formStore'])->name('form.pendaftaran.store');

Route::get('createSyncTagihan', function () {
    $id_siswa = Siswa::get()->pluck('id')->toArray();
    foreach ($id_siswa as $siswa) {
        Tagihan::create([
            'siswa_id' => $siswa,
            'jumlah_tagihan' => 2000000,
            'nama_tagihan' => 'PPDB',
        ]);
    }

    return 'Tagihan berhasil dibuat dan siswa berhasil disinkronkan.';
    
});
Route::get('/kwitansi/{pembayaran}/print', [KwitansiController::class, 'print'])
    ->name('kwitansi.print')
    ->middleware('auth');
Route::get('/verifikasi/{nomorPendaftaran}', [VerifikasiController::class, 'index'])
    ->name('verifikasi');
    
Route::get('pendaftaran', CreatePendaftar::class);
Route::get('tesfisik', CreateTesfisik::class);
Route::get('/post/{slug}',[PostController::class,'show'])->name('post.view');
Route::get('/pengumuman/{id}', function () {
    $tahun=Tahun::where('is_active',true)->first();
    $pengaturan=PengaturanWebsite::get();
    $siswa=Siswa::find(request('id'));
    return view('pengumuman', [
        'siswa'=>$siswa,
        'pengaturan'=>$pengaturan,
        'tahun'=>$tahun->nama_tahun
    ]);
})
->middleware('auth')->name('pengumuman.print');

Route::get('/cekstatus', function() {
    return view('cekstatus');
});