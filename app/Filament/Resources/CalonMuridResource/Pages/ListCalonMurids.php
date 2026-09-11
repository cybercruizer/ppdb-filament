<?php

namespace App\Filament\Resources\CalonMuridResource\Pages;

use App\Filament\Resources\CalonMuridResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListCalonMurids extends ListRecords
{
    protected static string $resource = CalonMuridResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
