<?php

namespace App\Filament\Exports;

use App\Models\Tagihan;
use Filament\Actions\Exports\ExportColumn;
use Filament\Actions\Exports\Exporter;
use Filament\Actions\Exports\Models\Export;

class TagihanExporter extends Exporter
{
    protected static ?string $model = Tagihan::class;

    public static function getColumns(): array
    {
        return [
            ExportColumn::make('siswa.nomor_pendaftaran')
                ->label('Nomor Pendaftaran'),
            ExportColumn::make('siswa.nama')
                ->label('Nama Siswa'),
            ExportColumn::make('siswa.gelombang.nama_gelombang')
                ->label('Gelombang'),
            ExportColumn::make('jumlah_tagihan')
                ->label('Jumlah Tagihan'),
            ExportColumn::make('terbayar')
                ->label('Jumlah Terbayar'),
            ExportColumn::make('status')
                ->label('Status'),
        ];
    }

    public static function getCompletedNotificationBody(Export $export): string
    {
        $body = 'Data tagihan berhasil diexport dan ' . number_format($export->successful_rows) . ' ' . str('row')->plural($export->successful_rows) . ' terekspor.';

        if ($failedRowsCount = $export->getFailedRowsCount()) {
            $body .= ' ' . number_format($failedRowsCount) . ' ' . str('row')->plural($failedRowsCount) . ' Gagal dieksport.';
        }

        return $body;
    }
}
