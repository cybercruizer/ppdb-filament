<?php

use App\Models\Siswa;
use App\Models\Tagihan;
use App\Livewire\CreateTesfisik;
use App\Livewire\CreatePendaftar;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\KwitansiController;
use App\Filament\Resources\PendaftaranResource\Pages\CreatePendaftaran;
use App\Http\Controllers\PostController;

Route::get('/', [HomeController::class, 'index'])->name('home');
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
    
Route::get('pendaftaran', CreatePendaftar::class);
Route::get('tesfisik', CreateTesfisik::class);
Route::get('/post/{id}',[PostController::class,'show'])->name('post.view');