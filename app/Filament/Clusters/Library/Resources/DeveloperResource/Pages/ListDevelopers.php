<?php

namespace App\Filament\Clusters\Library\Resources\DeveloperResource\Pages;

use App\Filament\Clusters\Library\Resources\DeveloperResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListDevelopers extends ListRecords
{
    protected static string $resource = DeveloperResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
