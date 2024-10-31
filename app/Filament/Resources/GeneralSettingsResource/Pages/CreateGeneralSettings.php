<?php

namespace App\Filament\Resources\GeneralSettingsResource\Pages;

use App\Filament\Resources\GeneralSettingsResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateGeneralSettings extends CreateRecord
{
    protected static string $resource = GeneralSettingsResource::class;
    protected static bool $canCreateAnother = false;
    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
