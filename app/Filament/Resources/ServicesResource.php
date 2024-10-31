<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ServicesResource\Pages;
use App\Filament\Resources\ServicesResource\RelationManagers;
use App\Models\Services;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ServicesResource extends Resource
{
    protected static ?string $model = Services::class;
    protected static ?string $navigationIcon = 'heroicon-o-wrench-screwdriver';

    protected static ?string $navigationGroup = 'Service Page';

    protected static ?string $navigationLabel = 'Service';
    protected static ?string $modelLabel = 'Service';
    protected static ?string $pluralModelLabel = 'Service';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Service Information')
                    ->schema([
                        Forms\Components\TextInput::make('service_title')
                            ->required()
                            ->placeholder('Masukkan judul')
                            ->maxLength(50)
                            ->label('Service Title'),

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


                        Forms\Components\Textarea::make('service_description')
                            ->required()
                            ->maxLength(350)
                            ->columnSpanFull()
                            ->placeholder('Masukkan deskripsi service')
                            ->label('Service Description'),


                    ])->columns(2)
                    ->columnSpan(['lg' => 2]),

                    
                Forms\Components\Section::make('Status Information')

                    ->schema([

                        Forms\Components\Placeholder::make('created_at')
                            ->label('Created at')
                            ->content(fn(?Services $record): string => $record ? $record->created_at->diffForHumans() : '-'),

                        Forms\Components\Placeholder::make('updated_at')
                            ->label('Last modified at')
                            ->content(fn(?Services $record): string => $record ? $record->updated_at->diffForHumans() : '-'),



                    ])->columnSpan(['lg' => 1]),

            ])->columns(3);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('service_title')
                    ->searchable()
                    ->sortable()
                    ->limit(30),

                Tables\Columns\TextColumn::make('icon')
                    ->formatStateUsing(fn(string $state): string => str_replace('fa-solid fa-', '', $state))
                    ->badge()
                    ->color('warning'),

                Tables\Columns\TextColumn::make('service_description')
                    ->limit(60),

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
            ->filters([])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make()
                        ->requiresConfirmation(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListServices::route('/'),
            'create' => Pages\CreateServices::route('/create'),
            'edit' => Pages\EditServices::route('/{record}/edit'),
        ];
    }
    public static function getNavigationBadge(): ?string
    {
        return static::getModel()::count();
    }

    public static function getGloballySearchableAttributes(): array
    {
        return [
            'service_title',
            'service_description',
            'icon'
        ];
    }
}
