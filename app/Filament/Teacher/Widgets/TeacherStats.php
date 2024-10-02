<?php

namespace App\Filament\Teacher\Widgets;

use App\Models\SectionUser;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Illuminate\Support\Facades\Auth;

class TeacherStats extends BaseWidget
{
    protected int | string | array $columnSpan = 3;

    protected function getStats(): array
    {
        $teacherId = Auth::id();
        $currentYear = now()->year;

        $sectionCount = SectionUser::where('teacher_id', $teacherId)
            ->where('year', $currentYear)
            ->distinct('section_id')
            ->count();

        $studentCount = SectionUser::where('teacher_id', $teacherId)
            ->where('year', $currentYear)
            ->distinct('student_id')
            ->count();

        return [
            Stat::make('Sections', $sectionCount)
                ->description('Number of sections you are teaching this year')
                ->icon('heroicon-o-academic-cap'),

            Stat::make('Students', $studentCount)
                ->description('Total number of students in your sections')
                ->icon('heroicon-o-users'),
        ];
    }

    protected function getColumns(): int
    {
        return 2;
    }
}
