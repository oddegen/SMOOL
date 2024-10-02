<?php

namespace App\Filament\Pages;

use App\Filament\Widgets\AdvancedStatsOverviewWidget;
use App\Filament\Widgets\Events;
use App\Filament\Widgets\InvoiceTable;
use App\Filament\Widgets\PerformanceMetrics;
use App\Filament\Widgets\RecentAnnouncements;

class Dashboard extends \Filament\Pages\Dashboard
{
    // ...

    public static function getNavigationLabel(): string
    {
        return __('Dashboard');
    }

    public function getColumns(): int|string|array
    {
        return 3;
    }

    public function getWidgets(): array
    {
        return [
            AdvancedStatsOverviewWidget::class,
            Events::class,
            RecentAnnouncements::class,
            PerformanceMetrics::class,
            InvoiceTable::class
        ];
    }
}
