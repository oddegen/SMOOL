<?php

namespace App\Filament\Clusters;

use Filament\Clusters\Cluster;

class Classes extends Cluster
{
    protected static ?string $navigationIcon = 'heroicon-o-academic-cap';

    public static function getNavigationLabel(): string
    {
        return __('Classes');
    }
}
