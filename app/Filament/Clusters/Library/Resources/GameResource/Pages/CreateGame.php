<?php

namespace App\Filament\Clusters\Library\Resources\GameResource\Pages;

use App\Filament\Clusters\Library\Resources\GameResource;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Wizard;
use Filament\Forms\Form;
use Filament\Resources\Pages\CreateRecord;

class CreateGame extends CreateRecord
{
    use CreateRecord\Concerns\HasWizard;

    protected static string $resource = GameResource::class;

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

    /** @return Wizard\Step[] */
    public function getSteps(): array
    {
        return [
            Wizard\Step::make('Information')
                ->schema([
                    Section::make()
                        ->schema(GameResource::getInformationSchema())
                        ->columnSpan(['lg' => 2]),

                    Section::make('Status')
                        ->schema(GameResource::getStatusSchema())
                        ->columnSpan(['lg' => 1]),
                ])
                ->columns(3),

            Wizard\Step::make('Associations')
                ->schema([
                    Section::make()->schema(GameResource::getAssociationsSchema()),
                ]),

            Wizard\Step::make('Platforms')
                ->schema([
                    Section::make()->schema([
                        GameResource::getPlatformsRepeater(),
                    ]),
                ]),

            Wizard\Step::make('Screenshots')
                ->schema([
                    Section::make()->schema([
                        GameResource::getScreenshotSchema(),
                    ]),
                ]),
        ];
    }
}
