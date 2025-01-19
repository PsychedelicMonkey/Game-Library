<?php

namespace App\Filament\Clusters\Library\Resources;

use App\Filament\Clusters\Library;
use App\Filament\Clusters\Library\Resources\GameResource\Pages;
use App\Filament\Clusters\Library\Resources\GameResource\RelationManagers;
use App\Models\Library\Game;
use App\Models\Library\Platform;
use Carbon\Carbon;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Pages\SubNavigationPosition;
use Filament\Resources\Pages\Page;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Route;
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
                            ->schema(static::getInformationSchema()),

                        Forms\Components\Section::make('Screenshots')
                            ->schema([
                                static::getScreenshotSchema(),
                            ])
                            ->collapsible(),

                        Forms\Components\Section::make('Platforms')
                            ->schema([
                                static::getPlatformsRepeater(),
                            ]),
                    ])
                    ->columnSpan(['lg' => 2]),

                Forms\Components\Group::make()
                    ->schema([
                        Forms\Components\Section::make('Status')
                            ->schema(static::getStatusSchema()),

                        Forms\Components\Section::make()
                            ->schema([
                                Forms\Components\Placeholder::make('created_at')
                                    ->label('Created at')
                                    ->content(fn (Game $record): string => $record->created_at->diffForHumans()),

                                Forms\Components\Placeholder::make('updated_at')
                                    ->label('Last modified at')
                                    ->content(fn (Game $record): string => $record->updated_at->diffForHumans()),
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
                Tables\Filters\Filter::make('release_date')
                    ->form([
                        Forms\Components\DatePicker::make('released_from')
                            ->native(false)
                            ->placeholder(fn ($state): string => 'Dec 18, ' . now()->subYear()->format('Y')),

                        Forms\Components\DatePicker::make('released_until')
                            ->native(false)
                            ->placeholder(fn ($state): string => now()->format('M d, Y')),
                    ])
                    ->query(function (Builder $query, array $data): Builder {
                        return $query
                            ->when(
                                $data['released_from'] ?? null,
                                fn (Builder $query, $date): Builder => $query->whereDate('release_date', '>=', $date),
                            )
                            ->when(
                                $data['released_until'] ?? null,
                                fn (Builder $query, $date): Builder => $query->whereDate('release_date', '<=', $date),
                            );
                    })
                    ->indicateUsing(function (array $data): array {
                        $indicators = [];
                        if ($data['released_from'] ?? null) {
                            $indicators['released_from'] = 'Released from ' . Carbon::parse($data['released_from'])->toFormattedDateString();
                        }
                        if ($data['released_until'] ?? null) {
                            $indicators['released_until'] = 'Released until ' . Carbon::parse($data['released_until'])->toFormattedDateString();
                        }

                        return $indicators;
                    }),
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
            'reviews' => Pages\ManageGameReviews::route('/{record}/reviews'),
        ];
    }

    public static function getRecordSubNavigation(Page $page): array
    {
        return $page->generateNavigationItems([
            Pages\EditGame::class,
            Pages\ManageGameReviews::class,
        ]);
    }

    public static function getSubNavigationPosition(): SubNavigationPosition
    {
        if (Route::currentRouteName() === Pages\EditGame::getRouteName() ||
            Route::currentRouteName() === Pages\ManageGameReviews::getRouteName()) {
            return SubNavigationPosition::Top;
        }

        return SubNavigationPosition::Start;
    }

    public static function getGloballySearchableAttributes(): array
    {
        return ['name', 'slug'];
    }

    /** @return Builder<Game> */
    public static function getGlobalSearchEloquentQuery(): Builder
    {
        return parent::getGlobalSearchEloquentQuery()->with(['developers', 'publishers']);
    }

    public static function getGlobalSearchResultDetails(Model $record): array
    {
        /** @var Game $record */

        return [
            'Developers' => optional($record->developers)->implode('name', ','),
            'Publishers' => optional($record->publishers)->implode('name', ','),
        ];
    }

    /** @return Forms\Components\Component[] */
    public static function getInformationSchema(): array
    {
        return [
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
        ];
    }

    /** @return Forms\Components\Component[] */
    public static function getStatusSchema(): array
    {
        return [
            Forms\Components\Toggle::make('is_visible')
                ->default(true)
                ->label('Visible to public'),

            Forms\Components\Toggle::make('is_featured')
                ->default(false)
                ->label('Featured game'),

            Forms\Components\DatePicker::make('release_date')
                ->native(false)
                ->placeholder(now()->format('M d, Y')),
        ];
    }

    /** @return Forms\Components\Component[] */
    public static function getAssociationsSchema(): array
    {
        // TODO: add create options to select fields.

        return [
            Forms\Components\Select::make('developers')
                ->multiple()
                ->relationship('developers', 'name')
                ->required()
                ->searchable(),

            Forms\Components\Select::make('publishers')
                ->multiple()
                ->relationship('publishers', 'name')
                ->required()
                ->searchable(),

            Forms\Components\Select::make('genres')
                ->multiple()
                ->relationship('genres', 'name')
                ->required()
                ->searchable(),
        ];
    }

    public static function getPlatformsRepeater(): Forms\Components\Repeater
    {
        return Forms\Components\Repeater::make('gamePlatforms')
            ->relationship()
            ->schema([
                // TODO: add create option to select.
                Forms\Components\Select::make('library_platform_id')
                    ->disableOptionsWhenSelectedInSiblingRepeaterItems()
                    ->distinct()
                    ->label('Platform')
                    ->options(Platform::query()->pluck('name', 'id'))
                    ->required()
                    ->searchable()
                    ->columnSpan([
                        'md' => 4,
                    ]),

                Forms\Components\TextInput::make('url')
                    ->label('URL')
                    ->maxLength(255)
                    ->placeholder('https://example.com')
                    ->url()
                    ->columnSpan([
                        'md' => 4,
                    ]),

                Forms\Components\DatePicker::make('release_date')
                    ->native(false)
                    ->placeholder(now()->format('M d, Y'))
                    ->columnSpan([
                        'md' => 2,
                    ]),
            ])
            ->addActionLabel('Add platform')
            ->collapsible()
            ->defaultItems(1)
            ->hiddenLabel()
            ->orderColumn('sort')
            ->reorderable()
            ->required()
            ->columns([
                'md' => 10,
            ]);
    }

    public static function getScreenshotSchema(): Forms\Components\SpatieMediaLibraryFileUpload
    {
        return Forms\Components\SpatieMediaLibraryFileUpload::make('images')
            ->collection('screenshots')
            ->hiddenLabel()
            ->image()
            ->imageEditor();
    }
}
