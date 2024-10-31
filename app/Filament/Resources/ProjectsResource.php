<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ProjectsResource\Pages;
use App\Models\Projects;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Tabs;
use Illuminate\Support\Facades\Storage;

class ProjectsResource extends Resource
{
    protected static ?string $model = Projects::class;
    protected static ?string $navigationIcon = 'heroicon-o-briefcase';
    protected static ?string $navigationGroup = 'Project Page';

    protected static ?string $navigationLabel = 'Project';
    protected static ?string $modelLabel = 'Project';
    protected static ?string $pluralModelLabel = 'Project';

    public static function getNavigationBadge(): ?string
    {
        return static::getModel()::count();
    }


    public static function getModelLabel(): string
    {
        return 'Project';
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Group::make()
                    ->schema([

                        Tabs::make('Project Information')
                            ->tabs([
                                Tabs\Tab::make('Basic Information')
                                    ->icon('heroicon-o-information-circle')
                                    ->schema([
                                        Forms\Components\TextInput::make('title')
                                            ->required()
                                            ->maxLength(255)
                                            ->placeholder('Masukkan judul')
                                            ->live(onBlur: true),

                                        Forms\Components\TextInput::make('category')
                                            ->placeholder('Masukkan kategori')
                                            ->required(),
                                        Forms\Components\TextInput::make('venue')
                                            ->required()
                                            ->placeholder('Masukkan venue')
                                            ->maxLength(255),
                                        Forms\Components\TextInput::make('attendees')
                                            ->numeric()
                                            ->placeholder('Masukkan jumlah peserta')
                                            ->suffix('people'),
                                        Forms\Components\DatePicker::make('date')
                                            ->required()
                                            ->placeholder('Masukkan tanggal')
                                            ->native(false),

                                        Forms\Components\Textarea::make('overview')
                                            ->placeholder('Masukkan overview singkat')
                                            ->columnSpanFull()
                                            ->required(),
                                    ])->columns(2),

                                Tabs\Tab::make('Media')
                                    ->icon('heroicon-o-photo')
                                    ->schema([
                                        Forms\Components\FileUpload::make('cover_img')
                                            ->image()
                                            ->required()
                                            ->directory('projects/covers')
                                            ->imageEditor()
                                            ->imageEditorAspectRatios(['3:2'])
                                            ->imageEditorViewportWidth('900')
                                            ->imageEditorViewportHeight('600')
                                            ->imageCropAspectRatio('3:2')
                                            ->imageResizeTargetWidth('900')
                                            ->imageResizeTargetHeight('600')
                                            ->columnSpanFull(),

                                        Forms\Components\FileUpload::make('banner_img')
                                            ->image()
                                            ->directory('projects/banners')
                                            ->imageEditor()
                                            ->imageEditorAspectRatios(['21:9'])
                                            ->imageEditorViewportWidth('2100')
                                            ->imageEditorViewportHeight('900')
                                            ->imageCropAspectRatio('21:9')
                                            ->imageResizeTargetWidth('2100')
                                            ->imageResizeTargetHeight('900')
                                            ->columnSpanFull(),

                                        Forms\Components\FileUpload::make('gallery')
                                            ->multiple()
                                            ->reorderable()
                                            ->image()
                                            ->directory('projects/gallery')
                                            ->imageEditor()
                                            ->imageEditorAspectRatios(['4:3'])
                                            ->imageEditorViewportWidth('1200')
                                            ->imageEditorViewportHeight('900')
                                            ->imageCropAspectRatio('4:3')
                                            ->imageResizeTargetWidth('1200')
                                            ->imageResizeTargetHeight('900')
                                            ->helperText('Multiple image for gallery')
                                            ->columnSpanFull()
                                            ->downloadable(),
                                    ]),

                                Tabs\Tab::make('Content')
                                    ->icon('heroicon-o-document-text')
                                    ->schema([
                                        Forms\Components\RichEditor::make('key_highlights')
                                            ->required()
                                            ->placeholder('Tuliskan poin-poin penting acara, seperti:
                                - Pencapaian dan milestone utama
                                - Aktivitas atau sesi yang menonjol
                                - Tokoh/pembicara penting yang hadir
                                - Hasil atau dampak signifikan
                                - Fitur khusus atau elemen unik acara')
                                            ->columnSpanFull(),

                                        Forms\Components\RichEditor::make('approach')
                                            ->required()
                                            ->placeholder('Jelaskan bagaimana acara ini dilaksanakan, seperti:
                                - Proses perencanaan dan persiapan
                                - Strategi pelaksanaan
                                - Koordinasi tim
                                - Solusi inovatif yang digunakan
                                - Tantangan yang dihadapi dan cara mengatasinya
                                - Metode untuk memastikan kesuksesan acara')
                                            ->columnSpanFull(),
                                    ]),

                                Tabs\Tab::make('Reviews')
                                    ->icon('heroicon-o-star')
                                    ->schema([
                                        Forms\Components\Textarea::make('review')
                                            ->placeholder('Masukkan ulasan')
                                            ->columnSpanFull(),
                                        Forms\Components\TextInput::make('reviewer')
                                            ->placeholder('Masukkan nama pemberi ulasan')
                                            ->maxLength(255),
                                        Forms\Components\TextInput::make('company_review')
                                            ->placeholder('Masukkan nama organisasi atau perusahaan pemberi ulasan')
                                            ->maxLength(255),
                                    ]),
                            ])->columnSpanFull(),
                    ])->columnSpan(['lg' => 3]),


                Forms\Components\Group::make()
                    ->schema([

                        Forms\Components\Section::make('Status Information')
                            ->schema([
                                Forms\Components\Placeholder::make('created_at')
                                    ->label('Created at')
                                    ->content(fn(?Projects $record): string => $record ? $record->created_at->diffForHumans() : '-'),

                                Forms\Components\Placeholder::make('updated_at')
                                    ->label('Last modified at')
                                    ->content(fn(?Projects $record): string => $record ? $record->updated_at->diffForHumans() : '-'),
                            ]),
                    ])->columnSpan(['lg' => 3]),
            ])->columns(3);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('title')
                    ->searchable()
                    ->sortable()
                    ->wrap(),
                Tables\Columns\TextColumn::make('category')
                    ->colors([
                        'warning'
                    ])
                    ->badge(),
                Tables\Columns\TextColumn::make('venue')
                    ->searchable(),
                Tables\Columns\TextColumn::make('attendees')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('date')
                    ->dateTime(' d M Y')
                    ->sortable(),
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
            ->defaultSort('date', 'desc')
            ->filters([
                Tables\Filters\Filter::make('upcoming')
                    ->query(fn(Builder $query): Builder => $query->where('date', '>=', now())),
                Tables\Filters\Filter::make('past')
                    ->query(fn(Builder $query): Builder => $query->where('date', '<', now())),
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

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListProjects::route('/'),
            'create' => Pages\CreateProjects::route('/create'),
            'edit' => Pages\EditProjects::route('/{record}/edit'),
        ];
    }

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()->latest();
    }
    public static function getGloballySearchableAttributes(): array
    {
        return [
            'title',
            'cover_img',
            'banner_img',
            'category',
            'overview',
            'key_highlights',
            'approach',
            'gallery',
            'venue',
            'attendees',
            'review',
            'reviewer',
            'company_review',
            'date',
        ];
    }
}
