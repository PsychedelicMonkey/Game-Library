<?php

namespace App\Filament\Clusters;

use Filament\Clusters\Cluster;

class Library extends Cluster
{
    protected static ?string $navigationGroup = 'Library';

    protected static ?string $navigationIcon = 'heroicon-o-squares-2x2';

    protected static ?int $navigationSort = 0;

    protected static ?string $slug = 'library';
}
