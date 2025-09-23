<?php

namespace App\Http\Controllers;

use App\Models\Tahun;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $posts = \App\Models\Post::latest()->take(3)->get();
        $ta= Tahun::where('is_active',true)->first();
        return view('ppdb', [
            'title' => 'SPMB '.$ta->nama_tahun,
            'posts' => $posts,
        ]);
    }
    public function form()
    {
        return view('form', [
            'title' => 'Formulir Pendaftaran',
        ]);
    }
    public function formStore(Request $request)
    {
        $request->validate([
            'jurusan' =>'required',
            'no_pendaf' => 'required',
            'nama' => 'required',
            'no_telp' => 'required',
            'nama_ayah' => 'required',
            'alamat' => 'required',
            'tempat_lahir' => 'required',
            'asal_sekolah' => 'required',
            'tgl_lahir'=> 'required',
            'captcha' => 'required|captcha',
            'jenis_kelamin' => 'required',
        ]);

        $tanggal_daftar = Carbon::now();
        $gelombang= Gelombang::whereDate('tanggal_awal','<=',$tanggal_daftar)->whereDate('tanggal_akhir','>=',$tanggal_daftar)->select('id','daftar_ulang')->first();
        //dd($gelombang->daftar_ulang);
        if($request->jenis_kelamin=="L"){
            $du=$gelombang->daftar_ulang;
        } else {
            $du=$gelombang->daftar_ulang+100000;
        }
        $data=$request->all();

        $siswa = new Siswa;
        $siswa -> nama = $data['nama'];
        $siswa -> no_pendaf = $data['no_pendaf'];
        $siswa -> jurusan = $data['jurusan'];
        
        $siswa -> tempat_lahir = $data['tempat_lahir'];
        $siswa -> tgl_lahir = $data['tgl_lahir'];
        $siswa -> jenis_kelamin = $data['jenis_kelamin'];

        $siswa -> alamat = $data['alamat'];
        $siswa -> asal_sekolah = $data['asal_sekolah'];
        $siswa -> no_telp = $data['no_telp'];
        $siswa -> kategori = 'REG';
        $siswa -> save();

        $ortu = new Ortu;
        $ortu -> siswa_id = $siswa->id;
        $ortu -> nama_ayah = $data['nama_ayah'];
        $ortu -> nama_ibu = $data['nama_ibu'];
        $ortu -> save();
        //ganti sesuai gelombang daftar
        $tagihan = new Tagihan;
        $tagihan -> siswa_id = $siswa->id;
        $tagihan -> nama_tagihan = "ppdb";
        $tagihan -> nominal = $du;
        $tagihan -> save();

        alert()->success('Sukses!','Data berhasil diinput');
        return redirect()->back();

        // Simpan data ke database
        \App\Models\Siswa::create($validated);

        return redirect()->route('form.pendaftaran')->with('success', 'Pendaftaran berhasil! Terima kasih telah mendaftar.');
    }
}
