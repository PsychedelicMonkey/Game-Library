<?php

declare(strict_types=1);

namespace App\Filament\Pages\Auth;

use App\Filament\Resources\UserResource;
use App\Models\User;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Pages\Auth\EditProfile as BaseEditProfile;

class EditProfile extends BaseEditProfile
{
    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make()
                    ->schema([
                        $this->getNameFormComponent(),
                        $this->getEmailFormComponent(),
                        $this->getPasswordFormComponent(),
                        $this->getPasswordConfirmationFormComponent(),
                    ]),

                Forms\Components\Section::make()
                    ->relationship('profile')
                    ->schema(UserResource::getProfileSchema()),
            ]);
    }

    public static function getLabel(): string
    {
        /** @var User $user */
        $user = auth()->user();

        return $user->name;
    }
}
