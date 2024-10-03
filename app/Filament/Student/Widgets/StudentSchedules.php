<?php

namespace App\Filament\Student\Widgets;

use App\Models\Schedule;
use Filament\Widgets\Widget;
use Saade\FilamentFullCalendar\Data\EventData;
use Saade\FilamentFullCalendar\Widgets\FullCalendarWidget;

class StudentSchedules extends FullCalendarWidget
{
    protected int | string | array $columnSpan = '2';

    public function fetchEvents(array $fetchInfo): array
    {
        return Schedule::query()
            ->whereHas('section', fn($query) => $query->whereHas('sectionUsers', fn($query) => $query->where('student_id', auth()->user()->id)))
            ->where('starts_at', '>=', $fetchInfo['start'])
            ->where('ends_at', '<=', $fetchInfo['end'])
            ->get()
            ->map(
                fn(Schedule $schedule) => EventData::make()
                    ->id($schedule->id)
                    ->title($schedule->title)
                    ->start($schedule->starts_at)
                    ->end($schedule->ends_at)
            )
            ->toArray();
    }

    public function config(): array
    {
        return [
            'initialView' => 'dayGridMonth',
            'headerToolbar' => [
                'left' => 'prev,next',
                'center' => 'title',
                'right' => '',
            ],
            'titleFormat' => [
                'month' => 'short',
                'day' => 'numeric'
            ],
            'dayHeaderFormat' =>
            [
                'weekday' => 'long'
            ],
            'eventMinHeight' => 50,
            'weekends' => false,
            'allDaySlot' => false,
            'scrollTimeReset' => false,
        ];
    }
}
