<?php

namespace App\Filament\Resources\MissionCardResource\Pages;

use App\Filament\Resources\MissionCardResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditMissionCard extends EditRecord
{
    protected static string $resource = MissionCardResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
