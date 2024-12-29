<?php

namespace App\Filament\Clusters\Library\Resources\GameResource\RelationManagers;

use App\Filament\Clusters\Library\Resources\DeveloperResource;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;

class DevelopersRelationManager extends RelationManager
{
    protected static string $relationship = 'developers';

    protected static ?string $recordTitleAttribute = 'name';

    public function form(Form $form): Form
    {
        return DeveloperResource::form($form);
    }

    public function table(Table $table): Table
    {
        return DeveloperResource::table($table)
            ->headerActions([
                Tables\Actions\AttachAction::make(),
                Tables\Actions\CreateAction::make(),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DetachAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DetachBulkAction::make(),
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ])
            ->defaultSort('sort')
            ->reorderable('sort');
    }
}
