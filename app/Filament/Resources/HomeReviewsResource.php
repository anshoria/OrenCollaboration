<?php

namespace App\Filament\Resources;

use App\Filament\Resources\HomeReviewsResource\Pages;
use App\Models\HomeReviews;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Forms\Components\FileUpload;
use Filament\Tables\Columns\ImageColumn;
use IbrahimBougaoua\FilamentRatingStar\Forms\Components\RatingStar;
use IbrahimBougaoua\FilamentRatingStar\Columns\Components\RatingStar as RatingTable;

class HomeReviewsResource extends Resource
{
    protected static ?string $model = HomeReviews::class;

    protected static ?string $navigationIcon = 'heroicon-o-chat-bubble-bottom-center-text';

    protected static ?string $navigationGroup = 'Home Page';

    protected static ?string $navigationLabel = 'Reviews Section';
    protected static ?string $modelLabel = 'Reviews Section';
    protected static ?string $pluralModelLabel = 'Reviews Section';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make()
                    ->schema([
                        Forms\Components\TextInput::make('name')
                            ->required()
                            ->placeholder('Masukkan nama')
                            ->maxLength(255),

                        Forms\Components\TextInput::make('position')
                            ->required()
                            ->placeholder('Contoh: CEO of Google')
                            ->maxLength(255),

                        RatingStar::make('star')
                            ->required()
                            ->label('Rating'),

                        Forms\Components\Textarea::make('description')
                            ->required()
                            ->placeholder('Masukkan deskripsi')
                            ->columnSpanFull()
                            ->maxLength(255)
                            ->rows(3),

                            FileUpload::make('profile_img')
                            ->image()
                            ->columnSpanFull()
                            ->label('Profile image')
                            ->imageEditor()
                            ->directory('reviews')
                            ->preserveFilenames()
                            ->imageEditorAspectRatios(['1:1'])
                            ->imageEditorViewportWidth('400')
                            ->imageEditorViewportHeight('400')
                            ->imageCropAspectRatio('1:1')
                            ->imageResizeTargetWidth('400')
                            ->imageResizeTargetHeight('400'),
                    ])
                    ->columns(2)
                    ->columnSpan(['lg' => 2]),
                Forms\Components\Section::make('Status Information')
                    ->schema([
                        Forms\Components\Placeholder::make('created_at')
                            ->label('Created at')
                            ->content(fn(?HomeReviews $record): string => $record ? $record->created_at->diffForHumans() : '-'),

                        Forms\Components\Placeholder::make('updated_at')
                            ->label('Last modified at')
                            ->content(fn(?HomeReviews $record): string => $record ? $record->updated_at->diffForHumans() : '-'),
                    ])->columnSpan(['lg' => 1]),
            ])
            ->columns(3);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->searchable()
                    ->sortable(),

                Tables\Columns\TextColumn::make('position')
                    ->searchable()
                    ->sortable(),

                Tables\Columns\TextColumn::make('description')
                    ->limit(50)
                    ->searchable(),


                    RatingTable::make('star'),

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
            ])
            ->defaultSort('created_at', 'desc');
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListHomeReviews::route('/'),
            'create' => Pages\CreateHomeReviews::route('/create'),
            'edit' => Pages\EditHomeReviews::route('/{record}/edit'),
        ];
    }

    public static function getNavigationBadge(): ?string
    {
        return static::getModel()::count();
    }
    public static function getGloballySearchableAttributes(): array
    {
        return [
            'name',
            'position',
            'description',
            'profile_img',
            'star',
        ];
    }
    
}
