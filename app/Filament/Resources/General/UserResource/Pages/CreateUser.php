<?php

namespace App\Filament\Resources\General\UserResource\Pages;

use App\Filament\Resources\General\UserResource;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Wizard;
use Filament\Forms\Components\Wizard\Step;
use Filament\Forms\Form;
use Filament\Resources\Pages\CreateRecord;

class CreateUser extends CreateRecord
{
    use CreateRecord\Concerns\HasWizard;

    protected static string $resource = UserResource::class;

    public function form(Form $form): Form
    {
        return parent::form($form)
            ->schema([
                Wizard::make()
                    ->steps($this->getSteps())
                    ->startOnStep($this->getStartStep())
                    ->cancelAction($this->getCancelFormAction())
                    ->submitAction($this->getSubmitFormAction())
                    ->contained(false),
            ])
            ->columns(null);
    }

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        unset($data['password_confirmation']);

        return $data;
    }

    /** @return Step[] */
    public function getSteps(): array
    {
        return [
            Step::make('User Information')
                ->schema([
                    Section::make()->schema(UserResource::getProfileInformationSchema())->columns(),
                ]),

            Step::make('Password')
                ->schema([
                    Section::make()->schema(UserResource::getPasswordSchema())->columns(),
                ]),
        ];
    }
}
