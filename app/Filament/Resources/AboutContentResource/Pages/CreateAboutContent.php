<?php

namespace App\Filament\Resources\AboutContentResource\Pages;

use App\Filament\Resources\AboutContentResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateAboutContent extends CreateRecord
{
    protected static string $resource = AboutContentResource::class;
    protected static bool $canCreateAnother = false;
    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}