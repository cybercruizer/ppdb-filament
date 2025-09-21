<?php

namespace App\Filament\Pages;

use App\Filament\Resources\SiswaResource;
use App\Filament\Resources\SiswaResource\Widgets\SiswaOverview;
use App\Filament\Widgets\SiswaChart;
use App\Models\Siswa;

class Dashboard extends \Filament\Pages\Dashboard
{
    
    public function getWidgets(): array
    {
        return [
            SiswaOverview::class,
            SiswaChart::class,
        ];
    }
}