<?php

namespace App\Filament\Resources\ServiceContentResource\Pages;

use App\Filament\Resources\ServiceContentResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateServiceContent extends CreateRecord
{
    protected static string $resource = ServiceContentResource::class;
    protected static bool $canCreateAnother = false;
    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
