<?php

namespace App\Filament\Resources\TesfisikResource\Widgets;

use App\Models\Tesfisik;
use Filament\Widgets\TableWidget as BaseWidget;
use Filament\Tables;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\DB;

class DistribusiUkuranBaju extends BaseWidget
{
    protected static ?string $heading = 'Rekap Ukuran Baju per Jurusan';

    protected function getTableQuery(): Builder
    {
        return Tesfisik::query()
            ->selectRaw('jurusans.kode_jurusan as jurusan')
            ->selectRaw("jurusans.kode_jurusan as row_key") // 👈 add this line
            ->selectRaw("SUM(CASE WHEN ukuran_baju = 'XXXL' THEN 1 ELSE 0 END) as XXXL")
            ->selectRaw("SUM(CASE WHEN ukuran_baju = 'XXL' THEN 1 ELSE 0 END) as XXL")
            ->selectRaw("SUM(CASE WHEN ukuran_baju = 'XL' THEN 1 ELSE 0 END) as XL")
            ->selectRaw("SUM(CASE WHEN ukuran_baju = 'L' THEN 1 ELSE 0 END) as L")
            ->selectRaw("SUM(CASE WHEN ukuran_baju = 'M' THEN 1 ELSE 0 END) as M")
            ->selectRaw("SUM(CASE WHEN ukuran_baju = 'S' THEN 1 ELSE 0 END) as S")
            ->join('siswas', 'tesfisiks.siswa_id', '=', 'siswas.id')
            ->join('jurusans', 'siswas.jurusan_id', '=', 'jurusans.id')
            ->groupBy('jurusans.kode_jurusan')
            ->orderBy('jurusans.kode_jurusan');
    }
    public function getTableRecordKey($record): string
    {
        return (string) ($record->row_key ?? uniqid());
    }


    protected function getTableColumns(): array
    {
        return [
            Tables\Columns\TextColumn::make('jurusan')->label('Jurusan')->sortable(),
            Tables\Columns\TextColumn::make('XXXL')->label('XXXL')->alignCenter(),
            Tables\Columns\TextColumn::make('XXL')->label('XXL')->alignCenter(),
            Tables\Columns\TextColumn::make('XL')->label('XL')->alignCenter(),
            Tables\Columns\TextColumn::make('L')->label('L')->alignCenter(),
            Tables\Columns\TextColumn::make('M')->label('M')->alignCenter(),
            Tables\Columns\TextColumn::make('S')->label('S')->alignCenter(),
        ];
    }

    protected function getTableFooter()
    {
        return Tables\Table::make()
            ->query(function () {
                return Tesfisik::query()
                    ->selectRaw("'TOTAL' as jurusan")
                    ->selectRaw("SUM(CASE WHEN ukuran_baju = 'XXXL' THEN 1 ELSE 0 END) as XXXL")
                    ->selectRaw("SUM(CASE WHEN ukuran_baju = 'XXL' THEN 1 ELSE 0 END) as XXL")
                    ->selectRaw("SUM(CASE WHEN ukuran_baju = 'XL' THEN 1 ELSE 0 END) as XL")
                    ->selectRaw("SUM(CASE WHEN ukuran_baju = 'L' THEN 1 ELSE 0 END) as L")
                    ->selectRaw("SUM(CASE WHEN ukuran_baju = 'M' THEN 1 ELSE 0 END) as M")
                    ->selectRaw("SUM(CASE WHEN ukuran_baju = 'S' THEN 1 ELSE 0 END) as S");
            });
    }
}
