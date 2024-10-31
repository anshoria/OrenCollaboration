<?php

namespace App\Filament\Resources\HomeReviewsResource\Pages;

use App\Filament\Resources\HomeReviewsResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;
use Illuminate\Support\Facades\Storage;

class EditHomeReviews extends EditRecord
{
    protected static string $resource = HomeReviewsResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }

    protected function mutateFormDataBeforeSave(array $data): array
    {
        $record = $this->getRecord();

        // Handle profile_img
        if (isset($data['profile_img']) && $data['profile_img'] !== $record->profile_img) {
            if ($record->profile_img && Storage::disk('public')->exists($record->profile_img)) {
                Storage::disk('public')->delete($record->profile_img);
            }
        }

        return $data;
    }

    protected function afterDelete(): void
    {
        $record = $this->getRecord();

        // Delete profile_img if exists
        if ($record->profile_img && Storage::disk('public')->exists($record->profile_img)) {
            Storage::disk('public')->delete($record->profile_img);
        }

    }
}
