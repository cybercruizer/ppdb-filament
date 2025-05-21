<?php

namespace App\Filament\Resources\SiswaResource\Pages;

use App\Models\Siswa;
use Filament\Actions;
use Filament\Resources\Components\Tab;
use App\Filament\Resources\SiswaResource;
use Filament\Resources\Pages\ListRecords;
use Illuminate\Database\Eloquent\Builder;


class ListSiswas extends ListRecords
{
    protected static string $resource = SiswaResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
    public function getTabs(): array
    {
        return [
            //make tabs using data from relationship jurusan->kode_jurusan

            // 'TKJ' => Tab::make('TKJ')
            //     ->badge(Siswa::whereHas('jurusan', fn (Builder $query) => $query->where('kode_jurusan', 'TKJ'))->count())
            //     ->modifyQueryUsing(fn (Builder $query) => $query->whereHas('jurusan', fn (Builder $subQuery) => $subQuery->where('kode_jurusan', 'TKJ'))),


            'Semua' => Tab::make('Semua')
                ->badge(Siswa::count()),
            'TKJ' => Tab::make('TKJ')
                ->modifyQueryUsing(fn (Builder $query) => $query->whereHas('jurusan', fn (Builder $subQuery) => $subQuery->where('kode_jurusan', 'TKJ')))
                ->badge(Siswa::whereHas('jurusan', fn (Builder $query) => $query->where('kode_jurusan', 'TKJ'))->count()),
            'TKR' => Tab::make('TKR')
                ->modifyQueryUsing(fn (Builder $query) => $query->whereHas('jurusan', fn (Builder $subQuery) => $subQuery->where('kode_jurusan', 'TKR')))
                ->badge(Siswa::whereHas('jurusan', fn (Builder $query) => $query->where('kode_jurusan', 'TKR'))->count()),
            'TITL' => Tab::make('TITL')
                ->modifyQueryUsing(fn (Builder $query) => $query->whereHas('jurusan', fn (Builder $subQuery) => $subQuery->where('kode_jurusan', 'TITL')))
                ->badge(Siswa::whereHas('jurusan', fn (Builder $query) => $query->where('kode_jurusan', 'TITL'))->count()),
            'TSM' => Tab::make('TSM')
                ->modifyQueryUsing(fn (Builder $query) => $query->whereHas('jurusan', fn (Builder $subQuery) => $subQuery->where('kode_jurusan', 'TSM')))
                ->badge(Siswa::whereHas('jurusan', fn (Builder $query) => $query->where('kode_jurusan', 'TSM'))->count()),
            'TPM' => Tab::make('TPM')
                ->modifyQueryUsing(fn (Builder $query) => $query->whereHas('jurusan', fn (Builder $subQuery) => $subQuery->where('kode_jurusan', 'TPM')))
                ->badge(Siswa::whereHas('jurusan', fn (Builder $query) => $query->where('kode_jurusan', 'TPM'))->count()),
            'PHT' => Tab::make('PHT')
                ->modifyQueryUsing(fn (Builder $query) => $query->whereHas('jurusan', fn (Builder $subQuery) => $subQuery->where('kode_jurusan', 'PHT')))
                ->badge(Siswa::whereHas('jurusan', fn (Builder $query) => $query->where('kode_jurusan', 'PHT'))->count()),
            'KUL' => Tab::make('KUL')
                ->modifyQueryUsing(fn (Builder $query) => $query->whereHas('jurusan', fn (Builder $subQuery) => $subQuery->where('kode_jurusan', 'KUL')))
                ->badge(Siswa::whereHas('jurusan', fn (Builder $query) => $query->where('kode_jurusan', 'KUL'))->count()),
        ];
    }
}