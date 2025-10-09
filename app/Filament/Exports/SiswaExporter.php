<?php

namespace App\Filament\Exports;

use App\Models\Siswa;
use Filament\Actions\Exports\ExportColumn;
use Filament\Actions\Exports\Exporter;
use Filament\Actions\Exports\Models\Export;

class SiswaExporter extends Exporter
{
    protected static ?string $model = Siswa::class;

    public static function getColumns(): array
    {
        return [
            ExportColumn::make('nomor_pendaftaran')
                ->label('Nomor Pendaftaran'),
            ExportColumn::make('nama')
                ->label('Nama'),
            ExportColumn::make('tempat_lahir')
                ->label('Tempat lahir'),
            ExportColumn::make('tanggal_lahir')
                ->label('tanggal_lahir'),
            ExportColumn::make('jenis_kelamin')
                ->label('Jenis kelamin'),
            ExportColumn::make('no_telepon')
                ->label('Nomor telepon'),
            ExportColumn::make('asal_sekolah')
                ->label('Asal sekolah'),
            ExportColumn::make('nama_ayah')
                ->label('Nama Ayah'),
            ExportColumn::make('nama_ibu')
                ->label('Nama ibu'),
            ExportColumn::make('alamat')
                ->label('Alamat'),
            ExportColumn::make('catatan')
                ->label('Catatan'),
            ExportColumn::make('jurusan.nama_jurusan')
                ->label('Jurusan'),
            ExportColumn::make('gelombang.nama_gelombang')
                ->label('Nama gelombang'),
            ExportColumn::make('informasi')
                ->label('Informasi'),
        ];
    }

    public static function getCompletedNotificationBody(Export $export): string
    {
        $body = 'Ekspor siswa berhasil dengan ' . number_format($export->successful_rows) . ' ' . str('row')->plural($export->successful_rows) . ' terekspor.';

        if ($failedRowsCount = $export->getFailedRowsCount()) {
            $body .= ' ' . number_format($failedRowsCount) . ' ' . str('row')->plural($failedRowsCount) . ' gagal mengekspor.';
        }

        return $body;
    }
}
