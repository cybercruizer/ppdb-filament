<?php

namespace App\Filament\Resources\GelombangResource\Pages;

use App\Filament\Resources\GelombangResource;
use Filament\Actions;
use Filament\Resources\Pages\ManageRecords;

class ManageGelombangs extends ManageRecords
{
    protected static string $resource = GelombangResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
