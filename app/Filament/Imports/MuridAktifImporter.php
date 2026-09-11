<?php

namespace App\Filament\Imports;

use App\Models\MuridAktif;
use Filament\Actions\Imports\ImportColumn;
use Filament\Actions\Imports\Importer;
use Filament\Actions\Imports\Models\Import;

class MuridAktifImporter extends Importer
{
    protected static ?string $model = MuridAktif::class;

    public static function getColumns(): array
    {
        return [
            ImportColumn::make('nis')
                ->rules(['required','unique:murid_aktifs,nis']),
            ImportColumn::make('kelas')
                ->rules(['required']),
            ImportColumn::make('nama')
                ->rules(['required']),
        ];
    }

    public function resolveRecord(): ?MuridAktif
    {
        return MuridAktif::firstOrNew([
            // Update existing records, matching them by `$this->data['column_name']`
            'nis' => $this->data['nis'],
        ]);

    }

    public static function getCompletedNotificationBody(Import $import): string
    {
        $body = 'Murid aktif sukses diimport dengan ' . number_format($import->successful_rows) . ' ' . str('row')->plural($import->successful_rows) . ' imported.';

        if ($failedRowsCount = $import->getFailedRowsCount()) {
            $body .= ' ' . number_format($failedRowsCount) . ' ' . str('row')->plural($failedRowsCount) . ' Gagal Import .';
        }

        return $body;
    }
}
