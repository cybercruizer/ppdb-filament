<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class JurusanController extends Controller
{
    public function deskripsi($kode_jurusan = null)
    {
        $jurusans = \App\Models\Jurusan::all();
        if ($kode_jurusan) {
            $jurusan = \App\Models\Jurusan::where('kode_jurusan', $kode_jurusan)->first();
            if (!$jurusan) {
                return redirect()->route('jurusan');
            }
        } else {
            $jurusan = null;
        }

        return view('jurusan', [
            'title' => 'Jurusan',
            'jurusans' => $jurusans,
            'selected_jurusan' => $jurusan,
        ]);
    }
}
