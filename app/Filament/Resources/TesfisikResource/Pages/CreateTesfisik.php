<?php

namespace App\Filament\Resources\TesfisikResource\Pages;

use App\Filament\Resources\TesfisikResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateTesfisik extends CreateRecord
{
    protected static string $resource = TesfisikResource::class;
    protected static bool $canCreateAnother = false;

    //customize redirect after create
    public function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
