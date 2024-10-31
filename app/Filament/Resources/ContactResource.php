<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ContactResource\Pages;
use App\Models\Contact;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class ContactResource extends Resource
{
    protected static ?string $model = Contact::class;

    // Ubah icon dan label
    protected static ?string $navigationIcon = 'heroicon-o-phone';
    protected static ?string $navigationLabel = 'Contact';
    protected static ?string $navigationGroup = 'Contact Page';
    protected static ?int $navigationSort = 9;
    protected static ?string $modelLabel = 'Contact';
    protected static ?string $pluralModelLabel = 'Contact';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Contact Information')
                    ->schema([
                        Forms\Components\TextInput::make('address')
                            ->label('Alamat')
                            ->required()
                            ->maxLength(255)
                            ->columnSpanFull()
                            ->placeholder('Masukkan alamat lengkap'),

                        Forms\Components\TextInput::make('phone')
                            ->label('Nomor Telepon')
                            ->tel()
                            ->required()
                            ->maxLength(255)
                            ->placeholder('Contoh: 0812xxxxxxxx'),

                        Forms\Components\TextInput::make('email')
                            ->label('Email')
                            ->email()
                            ->required()
                            ->maxLength(255)
                            ->placeholder('Contoh: info@example.com'),
                    ])->columns(2)
                    ->columnSpan(['lg' => 2]),

                Forms\Components\Section::make('Status Information')
                    ->schema([
                        Forms\Components\Placeholder::make('created_at')
                            ->label('Created at')
                            ->content(fn(?Contact $record): string => $record ? $record->created_at->diffForHumans() : '-'),

                        Forms\Components\Placeholder::make('updated_at')
                            ->label('Last modified at')
                            ->content(fn(?Contact $record): string => $record ? $record->updated_at->diffForHumans() : '-'),

                    ])->columnSpan(['lg' => 1]),

            ])
            ->columns(3);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('address')
                    ->label('Alamat')
                    ->wrap(),

                Tables\Columns\TextColumn::make('phone')
                    ->label('Nomor Telepon'),

                Tables\Columns\TextColumn::make('email')
                    ->label('Email'),

                Tables\Columns\TextColumn::make('created_at')
                    ->label('Dibuat Pada')
                    ->dateTime()
                    ->sortable()
                    ->toggleable()
                    ->toggledHiddenByDefault(),
                Tables\Columns\TextColumn::make('updated_at')
                    ->label('Diperbarui Pada')
                    ->dateTime()
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
            'index' => Pages\ListContacts::route('/'),
            'create' => Pages\CreateContact::route('/create'),
            'edit' => Pages\EditContact::route('/{record}/edit'),
        ];
    }
    public static function getGloballySearchableAttributes(): array
    {
        return [
            'address',
        'phone',
        'email',
        ];
    }
}
