<?php

namespace App\Http\Controllers;

use App\Models\Pembayaran;
use App\Models\Tahun;
use Illuminate\Http\Request;

class KwitansiController extends Controller
{
    public function print(Pembayaran $pembayaran)
    {
        // Load relasi yang dibutuhkan
        $pembayaran=Pembayaran::find($pembayaran->id);
        $tahunaktif=Tahun::where('is_active',true)->first();
        //dd($pembayaran);
        
        // Hitung total tagihan dan sisa
        $totalTagihan = $pembayaran->tagihan->jumlah_tagihan ?? 0;
        $totalPembayaran = $pembayaran->tagihan->pembayarans->sum('jumlah_pembayaran');
        $sisaTagihan = $totalTagihan - $totalPembayaran;
        
        // Tentukan status pembayaran
        $status = $sisaTagihan <= 0 ? 'LUNAS' : 'KURANG Rp ' . number_format($sisaTagihan, 0, ',', '.');
        
        return view('kwitansi.print', compact('pembayaran', 'status', 'sisaTagihan', 'totalTagihan', 'totalPembayaran','tahunaktif'));
    }
}