<?php

namespace App\Filament\Resources;

use App\Filament\Resources\HomeFeaturesResource\Pages;
use App\Models\HomeFeatures;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class HomeFeaturesResource extends Resource
{
    protected static ?string $model = HomeFeatures::class;

    protected static ?string $navigationIcon = 'heroicon-o-puzzle-piece';

    protected static ?string $navigationGroup = 'Home Page';

    protected static ?string $navigationLabel = 'Features Section';
    protected static ?string $modelLabel = 'Features Section';
    protected static ?string $pluralModelLabel = 'Features Section';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Keunggulan')
                    ->schema([
                        Forms\Components\TextInput::make('title')
                            ->required()
                            ->placeholder('Masukkan judul')
                            ->maxLength(255),
                        Forms\Components\Select::make('icon')
                            ->options([
                                'fa-solid fa-users' => 'Users',
                                'fa-solid fa-star' => 'Star',
                                'fa-solid fa-gear' => 'Gear',
                                'fa-solid fa-chart-line' => 'Chart Line',
                                'fa-solid fa-trophy' => 'Trophy',
                                'fa-solid fa-lightbulb' => 'Lightbulb',
                                'fa-solid fa-rocket' => 'Rocket',
                                'fa-solid fa-heart' => 'Heart',
                                'fa-solid fa-shield' => 'Shield',
                                'fa-solid fa-check' => 'Check',
                                'fa-solid fa-crown' => 'Crown',
                                'fa-solid fa-gem' => 'Gem',
                                'fa-solid fa-globe' => 'Globe',
                                'fa-solid fa-laptop' => 'Laptop',
                                'fa-solid fa-mobile' => 'Mobile',
                                'fa-solid fa-palette' => 'Palette',
                                'fa-solid fa-puzzle-piece' => 'Puzzle',
                                'fa-solid fa-search' => 'Search',
                                'fa-solid fa-thumbs-up' => 'Thumbs Up',
                                'fa-solid fa-bolt' => 'Bolt',
                                'fa-solid fa-cloud' => 'Cloud',
                                'fa-solid fa-cog' => 'Cog',
                                'fa-solid fa-comment' => 'Comment',
                                'fa-solid fa-envelope' => 'Envelope',
                                'fa-solid fa-file' => 'File',
                                'fa-solid fa-flag' => 'Flag',
                                'fa-solid fa-home' => 'Home',
                                'fa-solid fa-key' => 'Key',
                                'fa-solid fa-map-marker' => 'Map Marker',
                                'fa-solid fa-music' => 'Music',
                                'fa-solid fa-paper-plane' => 'Paper Plane',
                                'fa-solid fa-shopping-cart' => 'Shopping Cart',
                                'fa-solid fa-smile' => 'Smile',
                                'fa-solid fa-sun' => 'Sun',
                                'fa-solid fa-thumbtack' => 'Thumbtack',
                                'fa-solid fa-tree' => 'Tree',
                                'fa-solid fa-user' => 'User',
                                'fa-solid fa-video' => 'Video',
                                'fa-solid fa-wrench' => 'Wrench',
                            ])
                            ->required()
                            ->searchable()
                            ->label('Icon')
                            ->placeholder('Pilih ikon'),

                        Forms\Components\Textarea::make('description')
                            ->required()
                            ->maxLength(255)
                            ->placeholder('Masukkan deskripsi')
                            ->rows(3)
                            ->columnSpanFull(),


                    ])
                    ->columns(2)
                    ->columnSpan(['lg' => 2]),
                Forms\Components\Section::make('Status Information')
                    ->schema([
                        Forms\Components\Placeholder::make('created_at')
                            ->label('Created at')
                            ->content(fn(?HomeFeatures $record): string => $record ? $record->created_at->diffForHumans() : '-'),

                        Forms\Components\Placeholder::make('updated_at')
                            ->label('Last modified at')
                            ->content(fn(?HomeFeatures $record): string => $record ? $record->updated_at->diffForHumans() : '-'),
                    ])->columnSpan(['lg' => 1]),
            ])->columns(3);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('title')
                    ->searchable()
                    ->sortable(),

                Tables\Columns\TextColumn::make('description')
                    ->searchable()
                    ->sortable()
                    ->limit(50),

                Tables\Columns\TextColumn::make('created_at')
                    ->label('Dibuat Pada')
                    ->dateTime('d M Y, H:m')
                    ->sortable()
                    ->toggleable()
                    ->toggledHiddenByDefault(),
                Tables\Columns\TextColumn::make('updated_at')
                    ->label('Diperbarui Pada')
                    ->dateTime('d M Y, H:m')
                    ->sortable()
                    ->toggleable()
                    ->toggledHiddenByDefault(),
            ])
            ->defaultSort('created_at', 'desc')
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListHomeFeatures::route('/'),
            'create' => Pages\CreateHomeFeatures::route('/create'),
            'edit' => Pages\EditHomeFeatures::route('/{record}/edit'),
        ];
    }

    public static function getNavigationBadge(): ?string
    {
        return static::getModel()::count();
    }
    public static function getGloballySearchableAttributes(): array
    {
        return [
            'title',
            'description',
            'icon'
        ];
    }
}
