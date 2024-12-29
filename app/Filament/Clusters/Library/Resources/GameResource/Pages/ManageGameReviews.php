<?php

namespace App\Filament\Clusters\Library\Resources\GameResource\Pages;

use App\Filament\Clusters\Library\Resources\GameResource;
use App\Filament\Resources\Library\ReviewResource;
use Filament\Forms\Form;
use Filament\Infolists\Infolist;
use Filament\Resources\Pages\ManageRelatedRecords;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Contracts\Support\Htmlable;

class ManageGameReviews extends ManageRelatedRecords
{
    protected static string $resource = GameResource::class;

    protected static string $relationship = 'reviews';

    protected static ?string $navigationIcon = 'heroicon-o-star';

    public function getTitle(): string|Htmlable
    {
        $recordTitle = $this->getRecordTitle();

        $recordTitle = $recordTitle instanceof Htmlable ? $recordTitle->toHtml() : $recordTitle;

        return "Manage {$recordTitle} Reviews";
    }

    public static function getNavigationLabel(): string
    {
        return 'Manage Reviews';
    }

    public function getBreadcrumb(): string
    {
        return 'Reviews';
    }

    public function form(Form $form): Form
    {
        return ReviewResource::form($form);
    }

    public function table(Table $table): Table
    {
        return ReviewResource::table($table)
            ->headerActions([
                Tables\Actions\CreateAction::make(),
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public function infolist(Infolist $infolist): Infolist
    {
        return ReviewResource::infolist($infolist);
    }
}
