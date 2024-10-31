<?php

namespace App\Filament\Resources\HomeReviewsResource\Pages;

use App\Filament\Resources\HomeReviewsResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListHomeReviews extends ListRecords
{
    protected static string $resource = HomeReviewsResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
