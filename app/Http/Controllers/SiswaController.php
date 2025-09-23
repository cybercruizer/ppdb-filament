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

        return response()->json([
            'id' => $student->id,
            'nama' => $student->nama,
            'nomor_pendaftaran' => $student->nomor_pendaftaran,
            'is_accepted' => (bool) $student->is_accepted,
        ]);
    }
}
