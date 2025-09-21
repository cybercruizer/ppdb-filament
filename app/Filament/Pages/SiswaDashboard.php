<?php

namespace App\Filament\Pages;

use App\Filament\Resources\SiswaResource\Widgets\SiswaOverview;


class SiswaDashboard extends \Filament\Pages\Dashboard
{
    protected static ?string $navigationLabel = 'Siswa Dashboard';
    
    protected static ?string $title = 'Siswa Statistics';
    
    protected static ?string $navigationIcon = 'heroicon-o-academic-cap';
    protected static string $routePath = 'admin';

    public function getColumns(): int | string | array
    {
        return 8;
    }

    public function getWidgets(): array
    {
        return [
            SiswaOverview::class,
        ];
    }
}