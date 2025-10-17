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
            Stat::make('TSM', Jurusan::jumlahSiswaByKode('TSM').' / '.Jurusan::jumlahSiswaBayarByKode('TSM'))
                ->icon('heroicon-o-users'),
            Stat::make('TITL', Jurusan::jumlahSiswaByKode('TITL').' / '.Jurusan::jumlahSiswaBayarByKode('TITL'))
                ->icon('heroicon-o-users'),
            Stat::make('TPM', Jurusan::jumlahSiswaByKode('TPM').' / '.Jurusan::jumlahSiswaBayarByKode('TPM'))
                ->icon('heroicon-o-users'),
            Stat::make('TKJ', Jurusan::jumlahSiswaByKode('TKJ').' / '.Jurusan::jumlahSiswaBayarByKode('TKJ'))
                ->icon('heroicon-o-users'),
            Stat::make('TKR', Jurusan::jumlahSiswaByKode('TKR').' / '.Jurusan::jumlahSiswaBayarByKode('TKR'))
                ->icon('heroicon-o-users'),
            Stat::make('PHT', Jurusan::jumlahSiswaByKode('PHT').' / '.Jurusan::jumlahSiswaBayarByKode('PHT'))
                    ->icon('heroicon-o-users'),
            Stat::make('KUL', Jurusan::jumlahSiswaByKode('KUL').' / '.Jurusan::jumlahSiswaBayarByKode('KUL'))
                    ->icon('heroicon-o-users'),
        ];
    }
}
