<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PengaturanWebsiteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
         DB::table('pengaturan_website')->insert([
            ['key' => 'nama_sekolah', 'value' => 'SMK Muhammadiyah Mungkid'],
            ['key' => 'nama_kepala_sekolah', 'value' => 'Marzuni, M.Pd'],
            ['key' => 'nama_bendahara', 'value' => 'Dani Al Afif M H, M.Pd'],
            ['key' => 'nama_ketua_ppdb', 'value' => 'Mujabirul Khoir, S.Pd'],
            ['key' => 'no_telp_sekolah', 'value' => '(0293) 782029'],
            ['key' => 'ig_sekolah', 'value' => 'https://www.instagram.com/smk_muhumgkid'],
            ['key' => 'fb_sekolah', 'value' => 'https://facebook.com/smkmuhumgkid'],
            ['key' => 'website_sekolah', 'value' => 'https://smkmuhumgkid.sch.id'],
            ['key' => 'yt_sekolah', 'value' => 'https://www.youtube.com/@smkmuhammadiyahmungkid986'],
            ['key' => 'wa_sekolah', 'value' => '6285855401778'],
            ['key' => 'slogan_sekolah', 'value' => 'Membangun Generasi Unggul dengan Pendidikan Berkualitas'],
            ['key' => 'email_sekolah', 'value' => 'smkmuhumgkid@gmail.com'],
            ['key' => 'alamat_sekolah', 'value' => 'Jl. Pemandian Blabak, Mungkid, Magelang'],
            ['key' => 'admin_1', 'value' => '6285855401778'],
            ['key' => 'admin_2', 'value' => '6282145495330'],
            ['key' => 'admin_3', 'value' => '6282326298327'],
            ['key' => 'penambahan_biaya_putri', 'value' => '0'],
            ['key' => 'link_detail_beasiswa', 'value' => '/post/16'],
            ['key' => 'nomor_surat_pengumuman', 'value' => '265/III.4.AU/A/2026'],
        ]);
    }
}
