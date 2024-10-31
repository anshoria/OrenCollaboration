<?php

namespace App\Filament\Widgets;

use App\Models\HomeReview;
use App\Models\HomeReviews;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ImageColumn;
use Filament\Widgets\TableWidget as BaseWidget;
use IbrahimBougaoua\FilamentRatingStar\Columns\Components\RatingStar as RatingTable;

class LatestReviewsWidget extends BaseWidget
{
    protected static ?int $sort = 2; // Urutan widget
    protected int | string | array $columnSpan = 'full'; // Full width
    protected static ?string $heading = 'Latest Reviews';

    public function table(Table $table): Table
    {
        return $table
            ->query(
                HomeReviews::query()->latest()->limit(5) // Ambil 5 review terbaru
            )
            ->columns([
                ImageColumn::make('profile_img')
                    ->circular()
                    ->label('Photo'),
                
                TextColumn::make('name'),
                
                TextColumn::make('position'),
                
                TextColumn::make('description')
                    ->limit(50)
                    ->tooltip(function (TextColumn $column): ?string {
                        $state = $column->getState();
                        
                        if (strlen($state) <= 50) {
                            return null;
                        }
                        
                        return $state;
                    }),
                
                    RatingTable::make('star'),
                
                TextColumn::make('created_at')
                    ->label('Posted at')
                    ->dateTime('d M Y, H:m'),
            ])
            ->defaultSort('created_at', 'desc') 
            ->actions([
            ])
            ->bulkActions([
            ])
            ->poll('30s'); // Auto refresh setiap 30 detik
    }
}