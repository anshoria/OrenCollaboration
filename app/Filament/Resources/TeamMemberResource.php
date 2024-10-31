<?php

namespace App\Filament\Resources;

use App\Filament\Resources\TeamMemberResource\Pages;
use App\Models\TeamMember;
use Attribute;
use Closure;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Collection;

class TeamMemberResource extends Resource
{
    protected static ?string $model = TeamMember::class;

    protected static ?string $navigationIcon = 'heroicon-o-users';

    protected static ?string $navigationGroup = 'About Page';

    protected static ?string $navigationLabel = 'Team Member';
    protected static ?string $modelLabel = 'Team Member';
    protected static ?string $pluralModelLabel = 'Team Member';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Group::make()
                    ->schema([
                        Forms\Components\Section::make('Basic Information')
                            ->schema([
                                Forms\Components\TextInput::make('name')
                                    ->required()
                                    ->placeholder('Masukkan nama')
                                    ->maxLength(255),

                                Forms\Components\TextInput::make('position')
                                    ->required()
                                    ->placeholder('Masukkan posisi')
                                    ->maxLength(255),

                                Forms\Components\Textarea::make('description')
                                    ->required()
                                    ->maxLength(150)
                                    ->columnSpanFull()
                                    ->placeholder('Masukkan deskripsi')
                                    ->rows(2)
                                    ->helperText('Maximum 150 characters')
                                    ->rules([
                                        fn () => function (string $attribute, mixed $value, Closure $fail) {
                                            if (substr_count($value, "\n") > 1) {
                                                $fail("Description cannot exceed 2 lines.");
                                            }
                                        }
                                    ]),

                                Forms\Components\Toggle::make('is_active')
                                    ->label('Active')
                                    ->default(true)
                                    ->required(),

                                Forms\Components\TextInput::make('display_order')
                                    ->integer()
                                    ->default(0)
                                    ->hidden()
                                    ->required(),
                            ])->columns(2),

                        Forms\Components\Section::make('Social Media Links')
                            ->schema([
                                Forms\Components\TextInput::make('facebook_url')
                                    ->label('Facebook URL')
                                    ->url()
                                    ->placeholder('Masukkan facebook')
                                    ->maxLength(255),

                                Forms\Components\TextInput::make('twitter_url')
                                    ->label('Twitter URL')
                                    ->url()
                                    ->placeholder('Masukkan twitter')
                                    ->maxLength(255),

                                Forms\Components\TextInput::make('instagram_url')
                                    ->label('Instagram URL')
                                    ->url()
                                    ->placeholder('Masukkan instagram')
                                    ->maxLength(255),

                                Forms\Components\TextInput::make('tiktok_url')
                                    ->label('TikTok URL')
                                    ->url()
                                    ->placeholder('Masukkan tiktok')
                                    ->maxLength(255),
                            ])->columns(2),
                    ])->columnSpan(['lg' => 2]),

                Forms\Components\Group::make()
                    ->schema([
                        Forms\Components\FileUpload::make('image')
                            ->label('Profile Image')
                            ->image()
                            ->imageEditor()
                            ->required()
                            ->directory('team-members')
                            ->visibility('public')
                            ->imageResizeMode('cover') 
                            ->imageCropAspectRatio('1:1')
                            ->imageResizeTargetWidth('400')
                            ->imageResizeTargetHeight('400'),

                        Forms\Components\Section::make('Status Information')
                            ->schema([
                                Forms\Components\Placeholder::make('created_at')
                                    ->label('Created at')
                                    ->content(fn (?TeamMember $record): string => $record ? $record->created_at->diffForHumans() : '-'),

                                Forms\Components\Placeholder::make('updated_at')
                                    ->label('Last modified at')
                                    ->content(fn (?TeamMember $record): string => $record ? $record->updated_at->diffForHumans() : '-'),
                            ]),
                    ])->columnSpan(['lg' => 1]),
            ])
            ->columns(3);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\ImageColumn::make('image')
                    ->label('Photo')
                    ->circular()
                    ->disk('public')
                    ->size(40),

                Tables\Columns\TextColumn::make('name')
                    ->searchable()
                    ->sortable(),

                Tables\Columns\TextColumn::make('position')
                    ->searchable()
                    ->sortable(),

                Tables\Columns\IconColumn::make('is_active')
                    ->label('Active')
                    ->boolean()
                    ->sortable(),

                Tables\Columns\TextColumn::make('display_order')
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
            ->defaultSort('display_order')
            ->reorderable('display_order')
            ->filters([
                Tables\Filters\SelectFilter::make('is_active')
                    ->label('Status')
                    ->options([
                        '1' => 'Active',
                        '0' => 'Inactive',
                    ]),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                    Tables\Actions\BulkAction::make('activate')
                        ->label('Activate Selected')
                        ->icon('heroicon-o-check')
                        ->action(fn (Collection $records) => $records->each->update(['is_active' => true]))
                        ->requiresConfirmation()
                        ->deselectRecordsAfterCompletion(),
                    Tables\Actions\BulkAction::make('deactivate')
                        ->label('Deactivate Selected')
                        ->icon('heroicon-o-x-mark')
                        ->action(fn (Collection $records) => $records->each->update(['is_active' => false]))
                        ->requiresConfirmation()
                        ->deselectRecordsAfterCompletion(),
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
            'index' => Pages\ListTeamMembers::route('/'),
            'create' => Pages\CreateTeamMember::route('/create'),
            'edit' => Pages\EditTeamMember::route('/{record}/edit'),
        ];
    }

    public static function getNavigationBadge(): ?string
    {
        return static::getModel()::where('is_active', true)->count();
    }

    public static function getGloballySearchableAttributes(): array
    {
        return ['name', 'position', 'description'];
    }
    public function foto_barang(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => $value ? asset('storage/' . $value) : null,
        )->lazy();
    }
}