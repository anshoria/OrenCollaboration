<?php

namespace App\Filament\Resources;

use App\Filament\Resources\GeneralSettingsResource\Pages;
use App\Filament\Resources\GeneralSettingsResource\RelationManagers;
use App\Models\GeneralSettings;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Facades\Storage;

class GeneralSettingsResource extends Resource
{
    protected static ?string $model = GeneralSettings::class;

    protected static ?string $navigationIcon = 'heroicon-o-cog';  // Changed to cog icon since it's settings

    protected static ?string $navigationLabel = 'General Settings';

    protected static ?int $navigationSort = 1;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Group::make()
                    ->schema([
                        Forms\Components\Section::make('Brand Information')
                            ->schema([
                                Forms\Components\TextInput::make('brand_name')
                                    ->required()
                                    ->placeholder('Masukkan nama brand')
                                    ->maxLength(255),
                                Forms\Components\FileUpload::make('brand_logo')
                                    ->required()
                                    ->image()
                                    ->placeholder('Masukkan logo brand')
                                    ->maxSize(8000)
                                    ->helperText('*tipe file png')
                                    ->directory('brand'),
                            ]),

                        Forms\Components\Section::make('Social Media Links')
                            ->schema([
                                Forms\Components\TextInput::make('instagram')
                                    ->url()
                                    ->placeholder('Masukkan instagram')
                                    ->prefixIcon('heroicon-m-globe-alt')
                                    ->maxLength(255),
                                Forms\Components\TextInput::make('facebook')
                                    ->url()
                                    ->prefixIcon('heroicon-m-globe-alt')
                                    ->placeholder('Masukkan instagram')
                                    ->maxLength(255),
                                Forms\Components\TextInput::make('tiktok')
                                    ->url()
                                    ->prefixIcon('heroicon-m-globe-alt')
                                    ->placeholder('Masukkan instagram')
                                    ->maxLength(255),
                                Forms\Components\TextInput::make('twiter')
                                    ->url()
                                    ->prefixIcon('heroicon-m-globe-alt')
                                    ->placeholder('Masukkan instagram')
                                    ->maxLength(255),
                                Forms\Components\TextInput::make('youtube')
                                    ->url()
                                    ->prefixIcon('heroicon-m-globe-alt')
                                    ->placeholder('Masukkan instagram')
                                    ->maxLength(255),
                            ])->columns(2),
                    ])->columnSpan(['lg' => 2]),


                Forms\Components\Group::make()
                    ->schema([
                        Forms\Components\Section::make('Status Information')
                            ->schema([
                                Forms\Components\Placeholder::make('created_at')
                                    ->label('Created at')
                                    ->content(fn(?GeneralSettings $record): string => $record ? $record->created_at->diffForHumans() : '-'),

                                Forms\Components\Placeholder::make('updated_at')
                                    ->label('Last modified at')
                                    ->content(fn(?GeneralSettings $record): string => $record ? $record->updated_at->diffForHumans() : '-'),
                            ]),
                    ])->columnSpan(['lg' => 1]),
            ])->columns(3);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('brand_name'),
                Tables\Columns\ImageColumn::make('brand_logo'),
                Tables\Columns\TextColumn::make('instagram')
                    ->toggleable()
                    ->toggledHiddenByDefault(),
                Tables\Columns\TextColumn::make('facebook')
                    ->toggleable()
                    ->toggledHiddenByDefault(),
                Tables\Columns\TextColumn::make('tiktok')
                    ->toggleable()
                    ->toggledHiddenByDefault(),
                Tables\Columns\TextColumn::make('twiter')
                    ->toggleable()
                    ->toggledHiddenByDefault(),
                Tables\Columns\TextColumn::make('youtube')
                    ->toggleable()
                    ->toggledHiddenByDefault(),
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
                    ->label('Tambah Pengaturan'),
            ])
            ->emptyStateDescription('Setelah Anda menambahkan pengaturan, pengaturan akan muncul di sini.')
            ->emptyStateHeading('Belum ada pengaturan')
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
            'index' => Pages\ListGeneralSettings::route('/'),
            'create' => Pages\CreateGeneralSettings::route('/create'),
            'edit' => Pages\EditGeneralSettings::route('/{record}/edit'),
        ];
    }
    public static function getGloballySearchableAttributes(): array
    {
        return [
            'brand_name',
            'brand_logo',
            'instagram',
            'facebook',
            'tiktok',
            'twiter',
            'youtube'
        ];
    }
}
