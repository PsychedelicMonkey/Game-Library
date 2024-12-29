<?php

namespace App\Filament\Clusters\Library\Resources\GameResource\RelationManagers;

use App\Filament\Clusters\Library\Resources\GenreResource;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;

class GenresRelationManager extends RelationManager
{
    protected static string $relationship = 'genres';

    protected static ?string $recordTitleAttribute = 'name';

    public function form(Form $form): Form
    {
        return GenreResource::form($form);
    }

    public function table(Table $table): Table
    {
        return GenreResource::table($table)
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
