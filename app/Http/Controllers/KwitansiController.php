<?php

namespace App\Http\Controllers;

use App\Models\Tahun;
use App\Models\Pembayaran;
use Illuminate\Http\Request;
use App\Models\PengaturanWebsite;
use Illuminate\Support\Facades\Auth;

class KwitansiController extends Controller
{
    public function print(Pembayaran $pembayaran)
    {
        // Load relasi yang dibutuhkan
        $pembayaran=Pembayaran::find($pembayaran->id);
        $tahunaktif=Tahun::where('is_active',true)->first();
        //$bendahara = PengaturanWebsite::where('key', 'nama_bendahara')->first();
        $bendahara=Auth::user()->name;
        $pengaturan=PengaturanWebsite::all();
        //dd($bendahara);
        //dd($pembayaran);
        
        // Hitung total tagihan dan sisa
        $totalTagihan = $pembayaran->tagihan->jumlah_tagihan ?? 0;
        $totalPembayaran = $pembayaran->tagihan->pembayarans->sum('jumlah_pembayaran');
        $sisaTagihan = $totalTagihan - $totalPembayaran;
        
        // Tentukan status pembayaran
        $status = $sisaTagihan <= 0 ? 'LUNAS' : 'KURANG Rp ' . number_format($sisaTagihan, 0, ',', '.');
        
        return view('kwitansi.print', compact('pembayaran', 'status', 'sisaTagihan', 'totalTagihan', 'totalPembayaran','tahunaktif','bendahara','pengaturan'));
    }
}