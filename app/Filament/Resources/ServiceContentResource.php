<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ServiceContentResource\Pages;
use App\Models\ServiceContent;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Support\Enums\FontWeight;

class ServiceContentResource extends Resource
{
    protected static ?string $model = ServiceContent::class;

    protected static ?string $navigationIcon = 'heroicon-o-document-text';

    protected static ?string $navigationLabel = 'Service Page';

    protected static ?string $navigationGroup = 'Service Page';

    protected static ?string $modelLabel = 'Service page';
    protected static ?string $pluralModelLabel = 'Service page';

    protected static ?int $navigationSort = 3;
    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Subheading Information')
                    ->schema([
                        Forms\Components\Textarea::make('main_description')
                            ->required()
                            ->maxLength(350)
                            ->rows(3)
                            ->placeholder('Masukkan deskripsi utama')
                            ->columnSpanFull()
                            ->label('Main Description'),
                    ])
                    ->columnSpan(['lg' => 2]),
                Forms\Components\Section::make('Status Information')
                    ->schema([
                        Forms\Components\Placeholder::make('created_at')
                            ->label('Created at')
                            ->content(fn(?ServiceContent $record): string => $record ? $record->created_at->diffForHumans() : '-'),

                        Forms\Components\Placeholder::make('updated_at')
                            ->label('Last modified at')
                            ->content(fn(?ServiceContent $record): string => $record ? $record->updated_at->diffForHumans() : '-'),

                    ])->columnSpan(['lg' => 1]),
            ])->columns(3);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('main_description')
                    ->limit(80),

                Tables\Columns\TextColumn::make('created_at')
                    ->label('Dibuat Pada')
                    ->dateTime('d M Y, H:m')
                    ->toggleable()
                    ->toggledHiddenByDefault(),
                Tables\Columns\TextColumn::make('updated_at')
                    ->label('Diperbarui Pada')
                    ->dateTime('d M Y, H:m')
                    ->toggleable()
                    ->toggledHiddenByDefault(),
            ])
            ->defaultSort('created_at', 'desc')
            ->filters([])
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
            'index' => Pages\ListServiceContents::route('/'),
            'create' => Pages\CreateServiceContent::route('/create'),
            'edit' => Pages\EditServiceContent::route('/{record}/edit'),
        ];
    }

    public static function getGloballySearchableAttributes(): array
    {
        return [
            'main_description'
        ];
    }
}
