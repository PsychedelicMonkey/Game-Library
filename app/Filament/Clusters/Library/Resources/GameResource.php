<?php

namespace App\Filament\Clusters\Library\Resources;

use App\Filament\Clusters\Library;
use App\Filament\Clusters\Library\Resources\GameResource\Pages;
use App\Filament\Clusters\Library\Resources\GameResource\RelationManagers;
use App\Models\Game;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Support\Str;

class GameResource extends Resource
{
    protected static ?string $model = Game::class;

    protected static ?string $cluster = Library::class;

    protected static ?string $recordTitleAttribute = 'name';

    protected static ?string $navigationIcon = 'heroicon-o-puzzle-piece';

    protected static ?int $navigationSort = 0;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Group::make()
                    ->schema([
                        Forms\Components\Section::make()
                            ->schema([
                                Forms\Components\Grid::make()
                                    ->schema([
                                        Forms\Components\TextInput::make('name')
                                            ->maxLength(255)
                                            ->required()
                                            ->live(onBlur: true)
                                            ->afterStateUpdated(fn (Forms\Set $set, ?string $state) => $set('slug', Str::slug($state))),

                                        Forms\Components\TextInput::make('slug')
                                            ->disabled()
                                            ->dehydrated()
                                            ->maxLength(255)
                                            ->required()
                                            ->unique(Game::class, 'slug', ignoreRecord: true),
                                    ]),

                                Forms\Components\RichEditor::make('description')
                                    ->columnSpanFull(),
                            ]),

                        Forms\Components\Section::make('Screenshots')
                            ->schema([
                                Forms\Components\SpatieMediaLibraryFileUpload::make('images')
                                    ->collection('screenshots')
                                    ->hiddenLabel()
                                    ->image()
                                    ->imageEditor(),
                            ])
                            ->collapsible(),
                    ])
                    ->columnSpan(['lg' => 2]),

                Forms\Components\Group::make()
                    ->schema([
                        Forms\Components\Section::make('Status')
                            ->schema([
                                Forms\Components\Toggle::make('is_visible')
                                    ->default(true)
                                    ->label('Visible to public'),

                                Forms\Components\Toggle::make('is_featured')
                                    ->default(false)
                                    ->label('Featured game'),

                                Forms\Components\DatePicker::make('release_date')
                                    ->native(false)
                                    ->placeholder(now()->format('M d, Y')),
                            ]),

                        Forms\Components\Section::make()
                            ->schema([
                                Forms\Components\Placeholder::make('created_at')
                                    ->label('Created at')
                                    ->content(fn (Game $record): ?string => $record->created_at?->diffForHumans()),

                                Forms\Components\Placeholder::make('updated_at')
                                    ->label('Last modified at')
                                    ->content(fn (Game $record): ?string => $record->updated_at?->diffForHumans()),
                            ])
                            ->hidden(fn (?Game $record) => $record === null),
                    ])
                    ->columnSpan(['lg' => 1]),
            ])
            ->columns(3);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->searchable()
                    ->sortable(),

                Tables\Columns\TextColumn::make('slug')
                    ->searchable()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),

                Tables\Columns\TextColumn::make('developers.name')
                    ->searchable()
                    ->sortable()
                    ->limitList(2)
                    ->listWithLineBreaks()
                    ->expandableLimitedList(),

                Tables\Columns\IconColumn::make('is_visible')
                    ->boolean()
                    ->label('Visibility'),

                Tables\Columns\IconColumn::make('is_featured')
                    ->boolean()
                    ->label('Featured')
                    ->toggleable(isToggledHiddenByDefault: true),

                Tables\Columns\TextColumn::make('release_date')
                    ->date()
                    ->sortable(),

                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),

                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
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
            RelationManagers\DevelopersRelationManager::class,
            RelationManagers\GenresRelationManager::class,
            RelationManagers\PublishersRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListGames::route('/'),
            'create' => Pages\CreateGame::route('/create'),
            'edit' => Pages\EditGame::route('/{record}/edit'),
        ];
    }
}
