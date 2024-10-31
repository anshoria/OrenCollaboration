<?php

namespace App\Filament\Resources;

use App\Filament\Resources\VisionResource\Pages;
use App\Models\Vision;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class VisionResource extends Resource
{
    protected static ?string $model = Vision::class;

    protected static ?string $navigationIcon = 'heroicon-o-eye';
    
    protected static ?string $navigationGroup = 'About Page';

    protected static ?string $navigationLabel = 'Vision';
    protected static ?string $modelLabel = 'Vision';
    protected static ?string $pluralModelLabel = 'Vision';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Vision Information')
                    ->schema([
                        Forms\Components\Textarea::make('vision')
                            ->required()
                            ->columnSpanFull()
                            ->rows(3)
                            ->placeholder('Masukkan visi')
                            ->label('Vision Statement'),

                        Forms\Components\TextInput::make('events_completed')
                            ->required()
                            ->label('Events Completed')
                            ->numeric()
                            ->placeholder('Masukkan jumlah events')
                            ->minValue(0)
                            ->maxLength(255),

                        Forms\Components\TextInput::make('client_satisfaction')
                            ->required()
                            ->label('Client Satisfaction Rate (%)')
                            ->suffix('%')
                            ->numeric()
                            ->placeholder('Masukkan rating kepuasan pelanggan')
                            ->minValue(0)
                            ->maxValue(100)
                            ->maxLength(255),
                    ])
                    ->columns(2)
                    ->columnSpan(['lg' => 2]),

                    Forms\Components\Section::make('Status Information')
                    ->schema([
                        Forms\Components\Placeholder::make('created_at')
                            ->label('Created at')
                            ->content(fn(?Vision $record): string => $record ? $record->created_at->diffForHumans() : '-'),

                        Forms\Components\Placeholder::make('updated_at')
                            ->label('Last modified at')
                            ->content(fn(?Vision $record): string => $record ? $record->updated_at->diffForHumans() : '-'),
                    ])->columnSpan(['lg' => 1]),
            ]) ->columns(3);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('vision')
                    ->label('Vision Statement')
                    ->limit(50),
                    
                Tables\Columns\TextColumn::make('events_completed')
                    ->label('Events Completed'),
                    
                Tables\Columns\TextColumn::make('client_satisfaction')
                    ->label('Client Satisfaction')
                    ->suffix('%'),
                    
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

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListVisions::route('/'),
            'create' => Pages\CreateVision::route('/create'),
            'edit' => Pages\EditVision::route('/{record}/edit'),
        ];
    }

    public static function getGloballySearchableAttributes(): array
    {
        return [
            'vision',
            'events_completed',
            'client_satisfaction',
        ];
    }
}