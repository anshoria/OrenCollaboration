<?php

namespace App\Filament\Resources\HomeReviewsResource\Pages;

use App\Filament\Resources\HomeReviewsResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateHomeReviews extends CreateRecord
{
    protected static string $resource = HomeReviewsResource::class;
    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
