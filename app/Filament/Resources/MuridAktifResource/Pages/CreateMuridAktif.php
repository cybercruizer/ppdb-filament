<?php

namespace App\Filament\Resources\MuridAktifResource\Pages;

use App\Filament\Resources\MuridAktifResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateMuridAktif extends CreateRecord
{
    protected static string $resource = MuridAktifResource::class;
    protected static bool $canCreateAnother = false;

    //customize redirect after create
    public function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
