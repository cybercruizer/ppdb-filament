<?php

namespace App\Http\Controllers;

use App\Models\Tahun;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $posts = \App\Models\Post::take(3)->get();
        $ta= Tahun::where('is_active',true)->first();
        $pengaturan = \App\Models\PengaturanWebsite::all();
        //dd($pengaturan);
        
        return view('index_ppdb', [
            'title' => 'SPMB '.$ta->nama_tahun,
            'posts' => $posts,
            'pengaturan' => $pengaturan,
        ]);
    }
    public function informasi()
    {
        $posts = \App\Models\Post::latest()->get();
        //dd($pengaturan);
        
        return view('informasi', [
            'posts' => $posts,
        ]);
    }
}
