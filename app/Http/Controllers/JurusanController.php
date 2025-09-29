<?php

namespace App\Http\Controllers;

use App\Models\Jurusan;
use Illuminate\Http\Request;

class JurusanController extends Controller
{
    public function deskripsi($kode_jurusan)
    {
        $jurusan = Jurusan::where('kode_jurusan',$kode_jurusan)->firstOrFail();

        return view('jurusan', [
            'jurusan' => $jurusan,
        ]);
    }
}
