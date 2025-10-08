<?php

namespace App\Filament\Resources\TesfisikResource\Widgets;

use App\Models\Tesfisik;
use Filament\Widgets\StatsOverviewWidget\Card;
use Filament\Widgets\Concerns\InteractsWithPageFilters;
use Filament\Widgets\StatsOverviewWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class RekapBaju extends StatsOverviewWidget
{
    use InteractsWithPageFilters;
    protected ?string $heading = 'Rekap ukuran baju';
    
    protected function getCards(): array
    {
        $sizes = ['S','M','L','XL','XXL','XXXL'];
        return collect($sizes)->map(function($size){
            $count=Tesfisik::where('ukuran_baju',$size)->count();
            return Card::make($size,$count,' siswa')
            ->description("Ukuran {$size}")
            ->color(match ($size){
                'S' => 'success',
                'M' => 'info',
                'L' => 'warning',
                'XL' => 'danger',
                'XXL' => 'amber',
                'XXXL' => 'gray',
            });
        })->toArray();
    }
}
