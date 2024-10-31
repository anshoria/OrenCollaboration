<?php

namespace App\Filament\Resources;

use App\Filament\Resources\AboutContentResource\Pages;
use App\Models\AboutContent;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Support\Facades\Storage;

class AboutContentResource extends Resource
{
    protected static ?string $model = AboutContent::class;

    protected static ?string $navigationIcon = 'heroicon-o-document-text';

    protected static ?string $navigationGroup = 'About Page';

    protected static ?string $navigationLabel = 'About Page';
    protected static ?string $modelLabel = 'About page';
    protected static ?string $pluralModelLabel = 'About page';

    // Mengatur urutan grup navigasi
    protected static ?int $navigationSort = 2;
    

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Group::make()
                    ->schema([
                        Forms\Components\Section::make('Subheading Description')
                    ->schema([
                        Forms\Components\Textarea::make('main_description')
                            ->required()
                            ->placeholder('Masukkan deskripsi tentang OrenCollaboration')
                            ->maxLength(800)
                            ->rows(3)
                            ->columnSpanFull(),

                        Forms\Components\Textarea::make('vision_mission_section_description')
                            ->required()
                            ->maxLength(255)
                            ->placeholder('Masukkan kalimat singkat pada subjudul vision & mission')
                            ->label('Vision & Mission Description'),

                        Forms\Components\Textarea::make('team_section_description')
                            ->required()
                            ->maxLength(255)
                            ->placeholder('Masukkan kalimat singkat pada subjudul team member')
                            ->label('Team Section Description'),

                    ])->columns(2),
                Forms\Components\Section::make('Gambar Banner')
                    ->schema([
                        Forms\Components\FileUpload::make('hero_img')
                            ->required()
                            ->image()
                            ->imageEditor()
                            ->imageResizeMode('cover')
                            ->imageCropAspectRatio('16:9')
                            ->directory('about-page')
                            ->label('Banner 1'),

                        Forms\Components\FileUpload::make('hero_img2')
                            ->required()
                            ->image()
                            ->imageEditor()
                            ->imageResizeMode('cover')
                            ->imageCropAspectRatio('16:9')
                            ->directory('about-page')
                            ->label('Banner 2'),
                    ])->columns(2),
                    ])->columnSpan(['lg' => 2]),
                

                    Forms\Components\Group::make()
                    ->schema([
                        Forms\Components\Section::make('Status Information')
                            ->schema([
                                Forms\Components\Placeholder::make('created_at')
                                    ->label('Created at')
                                    ->content(fn (?AboutContent $record): string => $record ? $record->created_at->diffForHumans() : '-'),

                                Forms\Components\Placeholder::make('updated_at')
                                    ->label('Last modified at')
                                    ->content(fn (?AboutContent $record): string => $record ? $record->updated_at->diffForHumans() : '-'),
                            ]),
                    ])->columnSpan(['lg' => 1]),
            ])->columns(3);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('main_description')
                    ->label('Main Description')
                    ->limit(50),

                Tables\Columns\TextColumn::make('vision_mission_section_description')
                    ->label('Vision & Mission')
                    ->limit(50),

                Tables\Columns\TextColumn::make('team_section_description')
                    ->label('Team Section')
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
                Tables\Actions\EditAction::make(),
            ])
            ->emptyStateActions([
                Tables\Actions\CreateAction::make()
                    ->label('Tambah Halaman'),
            ])
            ->emptyStateDescription('Setelah Anda menambahkan halaman, halaman akan muncul di sini.')
            ->emptyStateHeading('Belum ada halaman')
            ->emptyStateIcon('heroicon-o-document-text')
            ->defaultPaginationPageOption(25)
            ->paginated([10, 25, 50, 100])
            ->poll('60s');
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
            'index' => Pages\ListAboutContents::route('/'),
            'create' => Pages\CreateAboutContent::route('/create'),
            'edit' => Pages\EditAboutContent::route('/{record}/edit'),
        ];
    }


    public static function getGloballySearchableAttributes(): array
    {
        return [
            'main_description',
            'vision_mission_section_description',
            'team_section_description'
        ];
    }
}
