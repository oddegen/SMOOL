<?php

namespace App\Filament\Clusters;

use Filament\Clusters\Cluster;

class Classes extends Cluster
{
    protected static ?string $navigationIcon = 'heroicon-o-academic-cap';

    protected static ?string $navigationGroup = 'Resources';

    protected static ?int $navigationSort = 0;

    public static function getNavigationLabel(): string
    {
        return __('Classes');
    }
}
