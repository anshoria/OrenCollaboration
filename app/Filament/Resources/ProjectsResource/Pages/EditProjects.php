<?php

namespace App\Filament\Resources\ProjectsResource\Pages;

use App\Filament\Resources\ProjectsResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;
use Illuminate\Support\Facades\Storage;

class EditProjects extends EditRecord
{
    protected static string $resource = ProjectsResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }

    protected function mutateFormDataBeforeSave(array $data): array
    {
        $record = $this->getRecord();

        // Handle cover_img
        if (isset($data['cover_img']) && $data['cover_img'] !== $record->cover_img) {
            if ($record->cover_img && Storage::disk('public')->exists($record->cover_img)) {
                Storage::disk('public')->delete($record->cover_img);
            }
        }
        // Handle banner_img
        if (isset($data['banner_img']) && $data['banner_img'] !== $record->banner_img) {
            if ($record->banner_img && Storage::disk('public')->exists($record->banner_img)) {
                Storage::disk('public')->delete($record->banner_img);
            }
        }
        // Handle gallery (multiple images)
        if (isset($data['gallery'])) {
            $oldGallery = is_string($record->gallery) ? json_decode($record->gallery, true) : $record->gallery ?? [];
            $newGallery = $data['gallery'];

            // Find images that were removed
            $removedImages = array_diff($oldGallery ?? [], $newGallery ?? []);

            // Delete removed images
            foreach ($removedImages as $image) {
                if (Storage::disk('public')->exists($image)) {
                    Storage::disk('public')->delete($image);
                }
            }
        }

        return $data;
    }

    protected function afterDelete(): void
    {
        $record = $this->getRecord();

        // Delete cover_img if exists
        if ($record->cover_img && Storage::disk('public')->exists($record->cover_img)) {
            Storage::disk('public')->delete($record->cover_img);
        }
        // Delete banner_img if exists
        if ($record->banner_img && Storage::disk('public')->exists($record->banner_img)) {
            Storage::disk('public')->delete($record->banner_img);
        }
        // Delete gallery images if they exist
        if ($record->gallery) {
            $gallery = is_string($record->gallery) ? json_decode($record->gallery, true) : $record->gallery;

            if (is_array($gallery)) {
                foreach ($gallery as $image) {
                    if (Storage::disk('public')->exists($image)) {
                        Storage::disk('public')->delete($image);
                    }
                }
            }
        }
    }
}
