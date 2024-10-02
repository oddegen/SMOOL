<?php

namespace App\Filament\Teacher\Pages;

use App\Filament\Teacher\Widgets\LatestSubmissions;
use App\Filament\Teacher\Widgets\TeacherInfoCard;
use App\Filament\Teacher\Widgets\TeacherSchedule;
use App\Filament\Teacher\Widgets\TeacherStats;
use Filament\Pages\Dashboard;

class TeacherDashboard extends Dashboard
{
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
            TeacherInfoCard::class,
            TeacherStats::class,
            TeacherSchedule::class,
            LatestSubmissions::class,
        ];
    }
}
