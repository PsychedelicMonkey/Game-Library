<?php

declare(strict_types=1);

namespace App\Filament\Resources\UserResource\Pages;

use App\Filament\Resources\UserResource;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Pages\ManageRelatedRecords;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Contracts\Support\Htmlable;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class ManageUserPhotos extends ManageRelatedRecords
{
    protected static string $resource = UserResource::class;

    protected static string $relationship = 'photos';

    protected static ?string $navigationIcon = 'heroicon-o-photo';

    public function getBreadcrumb(): string
    {
        return 'Photos';
    }

    public function getTitle(): string|Htmlable
    {
        $recordTitle = $this->getRecordTitle();

        $recordTitle = $recordTitle instanceof Htmlable ? $recordTitle->toHtml() : $recordTitle;

        return "Manage $recordTitle Photos";
    }

    public static function getNavigationLabel(): string
    {
        return 'Manage Photos';
    }

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Textarea::make('custom_properties.caption')
                    ->maxLength(255),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('user_id')
            ->columns([
                Tables\Columns\Layout\Stack::make([
                    Tables\Columns\ImageColumn::make('photo')
                        ->getStateUsing(fn (Media $record) => $record->getUrl())
                        ->height('100%')
                        ->width('100%'),
                ])->space(3),
            ])
            ->filters([
                //
            ])
            ->contentGrid([
                'md' => 2,
                'xl' => 3,
            ])
            ->paginated([
                18,
                36,
                72,
                'all',
            ])
            ->headerActions([
                // Tables\Actions\CreateAction::make(),
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
            ])
            ->emptyStateHeading('No photos yet')
            ->emptyStateDescription('Once this user uploads some photos, they will show up here.')
            ->emptyStateIcon('heroicon-m-photo');
    }
}
