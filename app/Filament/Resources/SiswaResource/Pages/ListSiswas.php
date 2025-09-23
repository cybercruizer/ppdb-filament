<?php

namespace App\Filament\Resources\SiswaResource\Pages;

use App\Filament\Exports\SiswaExporter;
use App\Models\Siswa;
use Filament\Actions;
use Filament\Resources\Components\Tab;
use App\Filament\Resources\SiswaResource;
use Filament\Actions\ExportAction;
use Filament\Resources\Pages\ListRecords;
use Illuminate\Database\Eloquent\Builder;


class ListSiswas extends ListRecords
{
    protected static string $resource = SiswaResource::class;

    protected function getHeaderActions(): array
    {
        return [
        ];
    }
    public function getTabs(): array
    {
        $jurusanCodes = \App\Models\Jurusan::pluck('kode_jurusan')->toArray();

        $tabs = [
            'Semua' => Tab::make('Semua')
            ->badge(Siswa::count()),
        ];

        foreach ($jurusanCodes as $kode) {
            $tabs[$kode] = Tab::make($kode)
            ->modifyQueryUsing(fn (Builder $query) => $query->whereHas('jurusan', fn (Builder $subQuery) => $subQuery->where('kode_jurusan', $kode)))
            ->badge(Siswa::whereHas('jurusan', fn (Builder $query) => $query->where('kode_jurusan', $kode))->count());
        }

        return $tabs;
    }
}