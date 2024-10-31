<?php

namespace App\Filament\Resources\HomeFeaturesResource\Pages;

use App\Filament\Resources\HomeFeaturesResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListHomeFeatures extends ListRecords
{
    protected static string $resource = HomeFeaturesResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
