<?php

namespace App\Filament\Resources\TesfisikResource\Pages;

use App\Filament\Resources\TesfisikResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListTesfisiks extends ListRecords
{
    protected static string $resource = TesfisikResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
