<?php

namespace App\Filament\Clusters\Library\Resources\GameResource\Pages;

use App\Filament\Clusters\Library\Resources\GameResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditGame extends EditRecord
{
    protected static string $resource = GameResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}