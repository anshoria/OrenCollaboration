<?php

namespace App\Filament\Resources\VisionResource\Pages;

use App\Filament\Resources\VisionResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateVision extends CreateRecord
{
    protected static string $resource = VisionResource::class;
    protected static bool $canCreateAnother = false;
    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
