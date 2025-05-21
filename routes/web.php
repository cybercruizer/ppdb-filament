<?php

use App\Models\Siswa;
use App\Models\Tagihan;
use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('welcome');
// });
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