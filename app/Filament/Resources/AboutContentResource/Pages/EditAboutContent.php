<?php

namespace App\Filament\Resources\AboutContentResource\Pages;

use App\Filament\Resources\AboutContentResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;
use Illuminate\Support\Facades\Storage;

class EditAboutContent extends EditRecord
{
    protected static string $resource = AboutContentResource::class;

  
    protected function mutateFormDataBeforeSave(array $data): array
    {
        $record = $this->getRecord();

        // Handle hero_img
        if (isset($data['hero_img']) && $data['hero_img'] !== $record->hero_img) {
            if ($record->hero_img && Storage::disk('public')->exists($record->hero_img)) {
                Storage::disk('public')->delete($record->hero_img);
            }
        }

        // Handle hero_img2
        if (isset($data['hero_img2']) && $data['hero_img2'] !== $record->hero_img2) {
            if ($record->hero_img2 && Storage::disk('public')->exists($record->hero_img2)) {
                Storage::disk('public')->delete($record->hero_img2);
            }
        }

        return $data;
    }

    protected function afterDelete(): void
    {
        $record = $this->getRecord();

        // Delete hero_img if exists
        if ($record->hero_img && Storage::disk('public')->exists($record->hero_img)) {
            Storage::disk('public')->delete($record->hero_img);
        }

        // Delete hero_img2 if exists
        if ($record->hero_img2 && Storage::disk('public')->exists($record->hero_img2)) {
            Storage::disk('public')->delete($record->hero_img2);
        }
    }
}
