<?php

declare(strict_types=1);

namespace App\Filament\Resources\UserResource\Pages;

use App\Filament\Resources\UserResource;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Wizard;
use Filament\Forms\Form;
use Filament\Resources\Pages\CreateRecord;

class CreateUser extends CreateRecord
{
    use CreateRecord\Concerns\HasWizard;

    protected static string $resource = UserResource::class;

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        unset($data['password_confirmation']);

        return $data;
    }

    public function form(Form $form): Form
    {
        return parent::form($form)
            ->schema([
                Wizard::make($this->getSteps())
                    ->startOnStep($this->getStartStep())
                    ->cancelAction($this->getCancelFormAction())
                    ->submitAction($this->getSubmitFormAction())
                    ->skippable($this->hasSkippableSteps())
                    ->contained(false),
            ])
            ->columns(null);
    }

    /** @return Wizard\Step[] */
    public function getSteps(): array
    {
        return [
            Wizard\Step::make('Name and email')
                ->schema([
                    Section::make()
                        ->schema(UserResource::getNameAndEmailSchema()),
                ]),

            Wizard\Step::make('Password')
                ->schema([
                    Section::make()
                        ->schema(UserResource::getPasswordSchema()),
                ]),

            Wizard\Step::make('Profile')
                ->schema([
                    Section::make()
                        ->relationship('profile')
                        ->schema(UserResource::getProfileSchema()),
                ]),
        ];
    }
}
