<?php

namespace App\Filament\Resources\CarouselResource\Pages;

use App\Filament\Resources\CarouselResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;
use Illuminate\Support\Facades\Storage;

class EditCarousel extends EditRecord
{
    protected static string $resource = CarouselResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }

    protected function mutateFormDataBeforeSave(array $data): array
    {
        $record = $this->getRecord();

        // Handle 
        if (isset($data['image']) && $data['image'] !== $record->image) {
            if ($record->image && Storage::disk('public')->exists($record->image)) {
                Storage::disk('public')->delete($record->image);
            }
        }

        return $data;
    }

    protected function afterDelete(): void
    {
        $record = $this->getRecord();

        // Delete image if exists
        if ($record->image && Storage::disk('public')->exists($record->image)) {
            Storage::disk('public')->delete($record->image);
        }
    }
}
