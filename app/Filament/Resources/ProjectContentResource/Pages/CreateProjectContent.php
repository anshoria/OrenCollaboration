<?php

namespace App\Filament\Resources\ProjectContentResource\Pages;

use App\Filament\Resources\ProjectContentResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateProjectContent extends CreateRecord
{
    protected static string $resource = ProjectContentResource::class;
    protected static bool $canCreateAnother = false;
    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
