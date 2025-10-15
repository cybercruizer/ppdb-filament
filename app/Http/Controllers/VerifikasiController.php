<?php

namespace App\Http\Controllers;

use App\Models\PengaturanWebsite;
use App\Models\Siswa;
use Illuminate\Http\Request;

class VerifikasiController extends Controller
{
    public function index($nomorPendaftaran)
    {
        $data=Siswa::where('nomor_pendaftaran',$nomorPendaftaran)->first();
        $pengaturan=PengaturanWebsite::get();
        $kepsek = $pengaturan->where('key','nama_kepala_sekolah')->value('value');
        $namaSekolah= $pengaturan->where('key','nama_sekolah')->value('value');
        //dd($namaSekolah);
        return view('verifikasi.index',[
            'data'=>$data,
            'kepsek' => $kepsek,
            'sekolah' => $namaSekolah
        ]);
    }
}
