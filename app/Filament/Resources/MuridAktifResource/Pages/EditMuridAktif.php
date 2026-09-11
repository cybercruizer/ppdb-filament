<?php

namespace App\Filament\Resources\MuridAktifResource\Pages;

use App\Filament\Resources\MuridAktifResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditMuridAktif extends EditRecord
{
    protected static string $resource = MuridAktifResource::class;

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
