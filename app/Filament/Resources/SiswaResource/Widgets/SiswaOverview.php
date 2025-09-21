<?php

namespace App\Filament\Resources\SiswaResource\Widgets;

use App\Models\Siswa;
use App\Models\Jurusan;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;

class SiswaOverview extends BaseWidget
{
    
    protected function getStats(): array
    {
        return [
            Stat::make('Jumlah Pendaftar',Siswa::get()->count())
                ->icon('heroicon-o-users')
                ->color('danger'),
            Stat::make('Daftar Ulang',Siswa::whereHas('tagihan', function ($query) {
                    $query->whereHas('pembayarans');
                })->count())
                ->icon('heroicon-o-credit-card'),
            Stat::make('TSM', Siswa::whereHas('jurusan', function ($query) {
                $query->where('kode_jurusan', 'TSM');
                })->count())
                ->icon('heroicon-o-users'),
            Stat::make('TITL', Siswa::whereHas('jurusan', function ($query) {
                $query->where('kode_jurusan', 'TITL');
                })->count())
                ->icon('heroicon-o-users'),
            Stat::make('TPM', Siswa::whereHas('jurusan', function ($query) {
                $query->where('kode_jurusan', 'TPM');
                })->count())
                ->icon('heroicon-o-users'),
            Stat::make('TKJ', Siswa::whereHas('jurusan', function ($query) {
                $query->where('kode_jurusan', 'TKJ');
                })->count())
                ->icon('heroicon-o-users'),
            Stat::make('TKR', Siswa::whereHas('jurusan', function ($query) {
                $query->where('kode_jurusan', 'TKR');
                })->count())
                ->icon('heroicon-o-users'),
            Stat::make('PHT', Siswa::whereHas('jurusan', function ($query) {
                    $query->where('kode_jurusan', 'PHT');
                    })->count())
                    ->icon('heroicon-o-users'),
            Stat::make('KUL', Siswa::whereHas('jurusan', function ($query) {
                    $query->where('kode_jurusan', 'KUL');
                    })->count())
                    ->icon('heroicon-o-users'),
        ];
    }
}
