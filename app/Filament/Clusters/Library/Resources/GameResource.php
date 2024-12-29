<?php

namespace App\Filament\Clusters\Library\Resources;

use App\Filament\Clusters\Library;
use App\Filament\Clusters\Library\Resources\GameResource\Pages;
use App\Filament\Clusters\Library\Resources\GameResource\RelationManagers;
use App\Models\Game;
use App\Models\Platform;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
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

    public static function getGloballySearchableAttributes(): array
    {
        return ['name', 'slug'];
    }

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
                    ->label('Platform')
                    ->options(Platform::query()->pluck('name', 'id'))
                    ->required()
                    ->searchable(),

                Forms\Components\TextInput::make('url')
                    ->label('URL')
                    ->maxLength(255)
                    ->url(),

                Forms\Components\DatePicker::make('release_date')
                    ->native(false)
                    ->placeholder(now()->format('M d, Y')),
            ])
            ->defaultItems(1)
            ->hiddenLabel()
            ->orderColumn('sort')
            ->reorderable()
            ->required();
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
