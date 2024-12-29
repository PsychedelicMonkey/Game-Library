<?php

namespace App\Filament\Clusters\Library\Resources\PlatformResource\Pages;

use App\Filament\Clusters\Library\Resources\PlatformResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditPlatform extends EditRecord
{
    protected static string $resource = PlatformResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
