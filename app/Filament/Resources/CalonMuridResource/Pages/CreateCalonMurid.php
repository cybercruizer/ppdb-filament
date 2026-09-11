<?php

namespace App\Filament\Resources\CalonMuridResource\Pages;

use App\Filament\Resources\CalonMuridResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateCalonMurid extends CreateRecord
{
    protected static string $resource = CalonMuridResource::class;
    protected static bool $canCreateAnother = false;

    //customize redirect after create
    public function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
