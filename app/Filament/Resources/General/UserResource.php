<?php

namespace App\Filament\Resources\General;

use App\Filament\Resources\General\UserResource\Pages;
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
                            ->schema(static::getProfileInformationSchema())
                            ->columns(2),

                        Forms\Components\Section::make('Password')
                            ->schema(static::getPasswordSchema())
                            ->columns(2)
                            ->footerActions([
                                fn (string $operation): Action => Action::make('save')
                                    ->action(function (Forms\Components\Section $component, EditRecord $livewire) {
                                        $livewire->saveFormComponentOnly($component);

                                        Notification::make()
                                            ->title('Password changed')
                                            ->success()
                                            ->send();
                                    })
                                    ->visible($operation === 'edit'),
                            ]),
                    ])
                    ->columnSpan(['lg' => fn (?User $record) => $record === null ? 3 : 2]),

                Forms\Components\Section::make()
                    ->schema([
                        Forms\Components\Placeholder::make('created_at')
                            ->label('Created at')
                            ->content(fn (User $record): ?string => $record->created_at?->diffForHumans()),

                        Forms\Components\Placeholder::make('updated_at')
                            ->label('Last modified at')
                            ->content(fn (User $record): ?string => $record->updated_at?->diffForHumans()),
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
                    ->searchable(isIndividual: true)
                    ->sortable(),

                Tables\Columns\TextColumn::make('email')
                    ->searchable(isIndividual: true, isGlobal: false)
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

    public static function getEloquentQuery(): Builder
    {
        /** @var User $user */
        $user = auth()->user();

        return parent::getEloquentQuery()
            ->whereKeyNot($user->getKey());
    }

    /** @return Forms\Components\Component[] */
    public static function getProfileInformationSchema(): array
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
                ->dehydrateStateUsing(fn (string $state): string => Hash::make($state))
                ->dehydrated(fn (?string $state): bool => filled($state))
                ->password()
                ->required()
                ->revealable()
                ->rule(Password::defaults()),

            Forms\Components\TextInput::make('password_confirmation')
                ->password()
                ->required()
                ->revealable(),
        ];
    }
}
