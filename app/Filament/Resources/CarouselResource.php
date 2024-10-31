<?php

namespace App\Filament\Resources;

use App\Filament\Resources\CarouselResource\Pages;
use App\Models\Carousel;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Storage;
use Filament\Forms\Components\FileUpload;
use Filament\Tables\Columns\ImageColumn;

class CarouselResource extends Resource
{
    protected static ?string $model = Carousel::class;

    protected static ?string $navigationIcon = 'heroicon-o-photo';

    protected static ?string $navigationGroup = 'Home Page';

    protected static ?string $navigationLabel = 'Image Slider';
    protected static ?string $modelLabel = 'Image Slider';
    protected static ?string $pluralModelLabel = 'Image Slider';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Image Slider Information')
                    ->schema([
                        Forms\Components\TextInput::make('title')
                            ->maxLength(255)
                            ->placeholder('Masukkan judul')
                            ->columnSpan('full'),

                        Forms\Components\TextInput::make('description')
                            ->maxLength(255)
                            ->placeholder('Masukkan deskripsi')
                            ->columnSpan('full'),

                        FileUpload::make('image')
                            ->image()
                            ->imageEditor()
                            ->directory('carousels')
                            ->preserveFilenames()
                            ->imageEditorAspectRatios([
                                '16:9'
                            ])
                            ->imageEditorViewportWidth('1920')
                            ->imageEditorViewportHeight('1080')
                            ->imageCropAspectRatio('16:9')
                            ->imageResizeTargetWidth('1920')
                            ->imageResizeTargetHeight('1080')
                            ->columnSpan('full')
                            ->required()
                    ])
                    ->columns(2)
                    ->columnSpan(['lg' => 2]),
                Forms\Components\Section::make('Status Information')
                    ->schema([
                        Forms\Components\Placeholder::make('created_at')
                            ->label('Created at')
                            ->content(fn(?Carousel $record): string => $record ? $record->created_at->diffForHumans() : '-'),

                        Forms\Components\Placeholder::make('updated_at')
                            ->label('Last modified at')
                            ->content(fn(?Carousel $record): string => $record ? $record->updated_at->diffForHumans() : '-'),
                    ])->columnSpan(['lg' => 1]),

            ])->columns(3);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                ImageColumn::make('image')
                    ->width(300)
                    ->height(100)
                    // ->rounded()
                    ->alignment('center'),

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
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make()
                    ->mutateFormDataUsing(function (array $data): array {
                        return $data;
                    }),

                Tables\Actions\DeleteAction::make()
                    ->before(function (Carousel $record) {
                        // Delete the image file when deleting the record
                        if ($record->image && Storage::exists($record->image)) {
                            Storage::delete($record->image);
                        }
                    }),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make()
                        ->before(function ($records) {
                            // Delete image files for bulk deleted records
                            foreach ($records as $record) {
                                if ($record->image && Storage::exists($record->image)) {
                                    Storage::delete($record->image);
                                }
                            }
                        }),
                ]),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListCarousels::route('/'),
            'create' => Pages\CreateCarousel::route('/create'),
            'edit' => Pages\EditCarousel::route('/{record}/edit'),
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
            'image',
        ];
    }
}
