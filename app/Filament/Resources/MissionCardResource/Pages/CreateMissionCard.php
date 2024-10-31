<?php

namespace App\Filament\Resources\MissionCardResource\Pages;

use App\Filament\Resources\MissionCardResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateMissionCard extends CreateRecord
{
    protected static string $resource = MissionCardResource::class;
    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
