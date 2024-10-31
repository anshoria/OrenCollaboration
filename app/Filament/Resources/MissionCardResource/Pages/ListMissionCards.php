<?php

namespace App\Filament\Resources\MissionCardResource\Pages;

use App\Filament\Resources\MissionCardResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListMissionCards extends ListRecords
{
    protected static string $resource = MissionCardResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
