<?php

namespace App\Filament\Pages;

use App\Models\Siswa;
use App\Filament\Widgets\SiswaChart;
use App\Filament\Resources\SiswaResource;
use App\Filament\Resources\TesfisikResource\Widgets\DistribusiUkuranBaju;
use App\Filament\Resources\TesfisikResource\Widgets\RekapBaju;
use App\Filament\Resources\SiswaResource\Widgets\SiswaOverview;

class Dashboard extends \Filament\Pages\Dashboard
{
    
    public function getWidgets(): array
    {
        return [
            SiswaOverview::class,
            SiswaChart::class,
            RekapBaju::class,
            DistribusiUkuranBaju::class,
        ];
    }
}