<?php

namespace App\Filament\Resources;

use App\Filament\Resources\MissionCardResource\Pages;
use App\Models\MissionCard;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Guava\FilamentIconPicker\Forms\IconPicker;

class MissionCardResource extends Resource
{
    protected static ?string $model = MissionCard::class;

    protected static ?string $navigationIcon = 'heroicon-o-clipboard-document-list';

    protected static ?string $navigationGroup = 'About Page';

    protected static ?string $navigationLabel = 'Mission';
    protected static ?string $modelLabel = 'Mission';
    protected static ?string $pluralModelLabel = 'Mission';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Mission Information')
                    ->schema([
                        Forms\Components\TextInput::make('mission_title')
                            ->required()
                            ->placeholder('Masukkan judul misi')
                            ->maxLength(255)
                            ->label('Mission Title'),

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

                        Forms\Components\TextArea::make('mission')
                            ->required()
                            ->maxLength(255)
                            ->columnSpanFull()
                            ->placeholder('Masukkan deskripsi misi')
                            ->label('Mission Description'),



                        Forms\Components\RichEditor::make('mission_detail')
                            ->required()
                            ->label('Mission Detail')
                            ->placeholder('Masukkan detail misi...')
                            ->toolbarButtons([
                                'bold',
                                'italic',
                                'underline',
                                'strike',
                                'bulletList',
                                'orderedList',
                                'link',
                                'undo',
                                'redo',
                            ])
                            ->columnSpan('full'),

                    ])->columns(2)
                    ->columnSpan(['lg' => 2]),

                Forms\Components\Section::make('Status Information')
                    ->schema([
                        Forms\Components\Placeholder::make('created_at')
                            ->label('Created at')
                            ->content(fn(?MissionCard $record): string => $record ? $record->created_at->diffForHumans() : '-'),

                        Forms\Components\Placeholder::make('updated_at')
                            ->label('Last modified at')
                            ->content(fn(?MissionCard $record): string => $record ? $record->updated_at->diffForHumans() : '-'),
                    ])->columnSpan(['lg' => 1]),
            ])->columns(3);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('mission_title')
                    ->searchable()
                    ->sortable()
                    ->label('Title'),

                Tables\Columns\TextColumn::make('mission')
                    ->searchable()
                    ->limit('70')
                    ->label('Mission'),

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
            ->filters([
                //
            ])
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
            'index' => Pages\ListMissionCards::route('/'),
            'create' => Pages\CreateMissionCard::route('/create'),
            'edit' => Pages\EditMissionCard::route('/{record}/edit'),
        ];
    }
    public static function getNavigationBadge(): ?string
    {
        return static::getModel()::count();
    }
    public static function getGloballySearchableAttributes(): array
    {
        return [
            'mission',
            'mission_title',
            'mission_detail',
            'icon'
        ];
    }
}
