<?php

namespace App\Filament\Resources\MuridAktifResource\Pages;

use Filament\Actions;
use Filament\Resources\Pages\ListRecords;
use Filament\Actions\ImportAction;
use App\Filament\Imports\MuridAktifImporter;
use App\Filament\Resources\MuridAktifResource;

class ListMuridAktifs extends ListRecords
{
    protected static string $resource = MuridAktifResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
            ImportAction::make("Import Murid")
                ->importer(MuridAktifImporter::class),
        ];
    }
}
