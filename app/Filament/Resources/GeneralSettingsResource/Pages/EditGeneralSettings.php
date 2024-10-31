<?php

namespace App\Filament\Resources\GeneralSettingsResource\Pages;

use App\Filament\Resources\GeneralSettingsResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;
use Illuminate\Support\Facades\Storage;

class EditGeneralSettings extends EditRecord
{
    protected static string $resource = GeneralSettingsResource::class;

    protected function mutateFormDataBeforeSave(array $data): array
    {
        $record = $this->getRecord();

        // Handle brand_logo
        if (isset($data['brand_logo']) && $data['brand_logo'] !== $record->brand_logo) {
            if ($record->brand_logo && Storage::disk('public')->exists($record->brand_logo)) {
                Storage::disk('public')->delete($record->brand_logo);
            }
        }

        return $data;
    }

    protected function afterDelete(): void
    {
        $record = $this->getRecord();

        // Delete brand_logo if exists
        if ($record->brand_logo && Storage::disk('public')->exists($record->brand_logo)) {
            Storage::disk('public')->delete($record->brand_logo);
        }
    }
}
