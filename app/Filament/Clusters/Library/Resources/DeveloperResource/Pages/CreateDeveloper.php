<?php

namespace App\Filament\Clusters\Library\Resources\DeveloperResource\Pages;

use App\Filament\Clusters\Library\Resources\DeveloperResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateDeveloper extends CreateRecord
{
    protected static string $resource = DeveloperResource::class;
}
