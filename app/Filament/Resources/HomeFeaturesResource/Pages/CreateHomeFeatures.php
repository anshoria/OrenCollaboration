<?php

namespace App\Filament\Resources\HomeFeaturesResource\Pages;

use App\Filament\Resources\HomeFeaturesResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateHomeFeatures extends CreateRecord
{
    protected static string $resource = HomeFeaturesResource::class;
    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
