<?php

declare(strict_types=1);

namespace App\Filament\Resources;

use App\Filament\Resources\UserResource\Pages;
use App\Models\User;
use Filament\Forms;
use Filament\Forms\Components\Actions\Action;
use Filament\Forms\Form;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\EditRecord;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;

class UserResource extends Resource
{
    protected static ?string $model = User::class;

    protected static ?string $slug = 'users';

    protected static ?string $recordTitleAttribute = 'name';

    protected static ?string $navigationIcon = 'heroicon-o-user-group';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Group::make()
                    ->schema([
                        Forms\Components\Section::make()
                            ->schema(self::getNameAndEmailSchema())
                            ->columns(2),

                        Forms\Components\Section::make('Password')
                            ->schema(self::getPasswordSchema())
                            ->footerActions([
                                fn (string $operation): Action => Action::make('save')
                                    ->action(function (Forms\Components\Section $component, EditRecord $livewire) {
                                        $livewire->saveFormComponentOnly($component);

                                        Notification::make()
                                            ->title('Password updated')
                                            ->success()
                                            ->send();
                                    })
                                    ->visible($operation === 'edit'),
                            ])
                            ->columns(2),

                        Forms\Components\Section::make('Profile')
                            ->relationship('profile')
                            ->schema(self::getProfileSchema()),
                    ])
                    ->columnSpan(['lg' => fn (?User $record) => $record === null ? 3 : 2]),

                Forms\Components\Section::make()
                    ->schema([
                        Forms\Components\Placeholder::make('created_at')
                            ->label('Created at')
                            ->content(fn (User $record) => $record->created_at->diffForHumans()),

                        Forms\Components\Placeholder::make('updated_at')
                            ->label('Last modified at')
                            ->content(fn (User $record) => $record->updated_at->diffForHumans()),
                    ])
                    ->columnSpan(['lg' => 1])
                    ->hidden(fn (?User $record) => $record === null),
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

                Tables\Columns\TextColumn::make('email')
                    ->searchable()
                    ->sortable(),

                Tables\Columns\TextColumn::make('email_verified_at')
                    ->dateTime()
                    ->sortable(),

                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),

                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),

                Tables\Columns\TextColumn::make('deleted_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                Tables\Filters\TrashedFilter::make(),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                    Tables\Actions\ForceDeleteBulkAction::make(),
                    Tables\Actions\RestoreBulkAction::make(),
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
            'index' => Pages\ListUsers::route('/'),
            'create' => Pages\CreateUser::route('/create'),
            'edit' => Pages\EditUser::route('/{record}/edit'),
        ];
    }

    /** @return Builder<User> */
    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()
            ->with('profile')
            ->withoutGlobalScopes([
                SoftDeletingScope::class,
            ]);
    }

    /** @return Forms\Components\Component[] */
    public static function getNameAndEmailSchema(): array
    {
        return [
            Forms\Components\TextInput::make('name')
                ->maxLength(255)
                ->required(),

            Forms\Components\TextInput::make('email')
                ->email()
                ->maxLength(255)
                ->required()
                ->unique(User::class, 'email', ignoreRecord: true),
        ];
    }

    /** @return Forms\Components\Component[] */
    public static function getPasswordSchema(): array
    {
        return [
            Forms\Components\TextInput::make('password')
                ->confirmed()
                ->dehydrated(fn (?string $state): bool => filled($state))
                ->dehydrateStateUsing(fn (string $state): string => Hash::make($state))
                ->password()
                ->required(fn (string $operation) => $operation === 'create')
                ->rule(Password::defaults()),

            Forms\Components\TextInput::make('password_confirmation')
                ->password()
                ->required(fn (string $operation) => $operation === 'create'),
        ];
    }

    /** @return Forms\Components\Component[] */
    public static function getProfileSchema(): array
    {
        return [
            Forms\Components\Textarea::make('bio')
                ->maxLength(250),

            Forms\Components\Toggle::make('is_public')
                ->default(true)
                ->label('Visible to public'),
        ];
    }
}
