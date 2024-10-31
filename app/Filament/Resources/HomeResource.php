<?php

namespace App\Filament\Resources;

use App\Filament\Resources\HomeResource\Pages;
use App\Models\Home;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class HomeResource extends Resource
{
    protected static ?string $model = Home::class;

    protected static ?string $navigationIcon = 'heroicon-o-home';

    protected static ?string $navigationGroup = 'Home Page';

    protected static ?string $navigationLabel = 'Home Page';
    protected static ?int $navigationSort = 1;
    protected static ?string $modelLabel = 'Home page';
    protected static ?string $pluralModelLabel = 'Home page';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Group::make()
                    ->schema([
                        Forms\Components\Section::make('Subheading Decription')
                            ->schema([
                                Forms\Components\Textarea::make('main_subheading')
                                    ->required()
                                    ->placeholder('Masukkan subjudul utama')
                                    ->maxLength(255),
                                Forms\Components\Textarea::make('review_subheading')
                                    ->required()
                                    ->placeholder('Masukkan subjudul review section')
                                    ->maxLength(255),
                            ])->columns(2),

                        Forms\Components\Section::make('Penawaran')
                            ->schema([
                                Forms\Components\TextInput::make('cta_title')
                                    ->label('Title')
                                    ->required()
                                    ->placeholder('Masukkan judul penawaran')
                                    ->maxLength(255),

                                Forms\Components\Textarea::make('cta_description')
                                    ->required()
                                    ->label('Description')
                                    ->placeholder('Masukkan deskripsi penawaran')
                                    ->maxLength(255)
                                    ->rows(3),
                            ]),
                    ])->columnSpan(['lg' => 2]),


                Forms\Components\Group::make()
                    ->schema([
                        Forms\Components\Section::make('Status Information')
                            ->schema([
                                Forms\Components\Placeholder::make('created_at')
                                    ->label('Created at')
                                    ->content(fn(?Home $record): string => $record ? $record->created_at->diffForHumans() : '-'),

                                Forms\Components\Placeholder::make('updated_at')
                                    ->label('Last modified at')
                                    ->content(fn(?Home $record): string => $record ? $record->updated_at->diffForHumans() : '-'),
                            ]),
                    ])->columnSpan(['lg' => 1]),
            ])->columns(3);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('main_subheading')
                    ->limit(50),
                Tables\Columns\TextColumn::make('review_subheading')
                    ->limit(50),
                Tables\Columns\TextColumn::make('cta_title')
                    ->label('Penawaran')
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

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListHomes::route('/'),
            'create' => Pages\CreateHome::route('/create'),
            'edit' => Pages\EditHome::route('/{record}/edit'),
        ];
    }
    public static function getGloballySearchableAttributes(): array
    {
        return [
            'main_subheading',
            'review_subheading',
            'cta_title',
            'cta_description',
        ];
    }
}
