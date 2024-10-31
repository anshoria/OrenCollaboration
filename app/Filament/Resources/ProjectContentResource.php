<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ProjectContentResource\Pages;
use App\Models\ProjectContent;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;

class ProjectContentResource extends Resource
{
    protected static ?string $model = ProjectContent::class;
    protected static ?string $navigationIcon = 'heroicon-o-document-text';
    protected static ?string $navigationGroup = 'Project Page';
    protected static ?string $navigationLabel = 'Project Page';
    protected static ?int $navigationSort = 4;
    protected static ?string $modelLabel = 'Project page';
    protected static ?string $pluralModelLabel = 'Project page';


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
                                    ->rows(3)
                                    ->columnSpanFull()
                                    ->label('Main Description')
                                    ->placeholder('Masukkan subjudul utama'),
                            ]),

                        Forms\Components\Section::make('Review Information')
                            ->schema([
                                Forms\Components\Textarea::make('review')
                                    ->required()
                                    ->columnSpanFull()
                                    ->rows(3)
                                    ->placeholder('Masukkan ulasan')
                                    ->label('Client Review'),
                                Forms\Components\TextInput::make('reviewer')
                                    ->required()
                                    ->maxLength(255)
                                    ->placeholder('Masukkan nama pemberi ulasan')
                                    ->label('Reviewer Name')
                                    ->placeholder('Enter reviewer name'),
                                Forms\Components\TextInput::make('company_review')
                                    ->required()
                                    ->maxLength(255)
                                    ->placeholder('Masukkan nama organisasi atau perusahaan pemberi ulasan')
                                    ->label('Company Name')
                                    ->placeholder('Enter company name'),
                            ])->columns(2),
                    ])->columnSpan(['lg' => 2]),


                Forms\Components\Group::make()
                    ->schema([

                        Forms\Components\Section::make('Status Information')
                            ->schema([
                                Forms\Components\Placeholder::make('created_at')
                                    ->label('Created at')
                                    ->content(fn(?ProjectContent $record): string => $record ? $record->created_at->diffForHumans() : '-'),

                                Forms\Components\Placeholder::make('updated_at')
                                    ->label('Last modified at')
                                    ->content(fn(?ProjectContent $record): string => $record ? $record->updated_at->diffForHumans() : '-'),
                            ]),
                    ])->columnSpan(['lg' => 1]),
            ])->columns(3);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('main_description')
                ->limit('60')
                    ->label('Subheading'),
                Tables\Columns\TextColumn::make('reviewer')
                    ->label('Reviewer'),
                Tables\Columns\TextColumn::make('company_review')
                    ->label('Company'),
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

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListProjectContents::route('/'),
            'create' => Pages\CreateProjectContent::route('/create'),
            'edit' => Pages\EditProjectContent::route('/{record}/edit'),
        ];
    }

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()->latest();
    }
    public static function getGloballySearchableAttributes(): array
    {
        return [
            'main_description',
            'review',
            'reviewer',
            'company_review',
        ];
    }
}
