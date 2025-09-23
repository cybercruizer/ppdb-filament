<?php

namespace App\Filament\Resources\TesfisikResource\Pages;

use App\Filament\Resources\TesfisikResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditTesfisik extends EditRecord
{
    protected static string $resource = TesfisikResource::class;

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
