<?php

namespace App\Filament\Resources\CalonMuridResource\Pages;

use App\Filament\Resources\CalonMuridResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditCalonMurid extends EditRecord
{
    protected static string $resource = CalonMuridResource::class;

    protected function getHeaderActions(): array
    {
        return [
        ];
    }

    //customize redirect after create
    public function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
