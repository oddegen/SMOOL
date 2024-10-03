<?php

namespace App\Filament\Student\Pages;

use App\Filament\Student\Widgets\LatestGradeWidget;
use App\Filament\Student\Widgets\StudentSchedules;
use App\Filament\Teacher\Widgets\TeacherInfoCard;
use Filament\Pages\Dashboard;

class StudentDashboard extends Dashboard
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
            StudentSchedules::class,
            LatestGradeWidget::class,
        ];
    }
}
