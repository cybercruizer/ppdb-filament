<?php

namespace App\Http\Controllers;

use App\Models\Siswa;
use Illuminate\Http\Request;

class SiswaController extends Controller
{
    public function cek($nomor)
    {
        $student = Siswa::where('nomor_pendaftaran', $nomor)->first();

        if (!$student) {
            return response()->json(['message' => 'Not found'], 404);
        }
        //cek siswa apakah sudah memiliki relasi tesfisik atau belum
        if(Siswa::where('nomor_pendaftaran', $nomor)->whereHas('tesfisik')->exists()){
            $status_fisik='Sudah tes fisik';
        } else {
            $status_fisik='Belum tes fisik';
        }

        return response()->json([
            'id' => $student->id,
            'nama' => $student->nama,
            'nomor_pendaftaran' => $student->nomor_pendaftaran,
            'status_fisik' => $status_fisik,
            'is_accepted' => (bool) $student->is_accepted,
        ]);
    }
}
