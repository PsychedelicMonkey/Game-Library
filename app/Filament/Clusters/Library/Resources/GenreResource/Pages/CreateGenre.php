<?php

namespace App\Filament\Clusters\Library\Resources\GenreResource\Pages;

use App\Filament\Clusters\Library\Resources\GenreResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateGenre extends CreateRecord
{
    protected static string $resource = GenreResource::class;
}
