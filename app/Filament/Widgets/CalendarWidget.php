<?php

namespace App\Filament\Widgets;

use App\Filament\Resources\ScheduleResource;
use App\Models\Batch;
use App\Models\Role;
use App\Models\Schedule;
use App\Models\Section;
use App\Models\Subject;
use App\Models\User;
use Carbon\Carbon;
use Filament\Actions\Action;
use Filament\Actions\CreateAction;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Get;
use Filament\Widgets\Widget;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Saade\FilamentFullCalendar\Widgets\FullCalendarWidget;

class CalendarWidget extends FullCalendarWidget
{


    public function fetchEvents(array $fetchInfo): array
    {
        return Schedule::query()->whereBelongsTo(Auth::user())
            ->where('starts_at', '<=', $fetchInfo['end'])
            ->where('ends_at', '>=', $fetchInfo['start'])
            ->get()
            ->map(
                fn(Schedule $event) => [
                    'id' => $event->id,
                    'title' => $event->subject()->first()->name,
                    'rrule' => [
                        'freq' => 'weekly',
                        'dtstart' => $event->starts_at->format('Y-m-d\TH:i:s'),
                        'until' => Carbon::parse($event->school_year . '-12-31')->format('Y-m-d'),
                    ],
                    'duration' => $event->starts_at->diffInSeconds($event->ends_at),
                ]
            )
            ->all();
    }

    public function config(): array
    {
        return [
            'initialView' => 'timeGridWeek',
            'headerToolbar' => [
                'left' => 'prev,next,today',
                'center' => 'title',
                'right' => 'timeGridWeek,timeGridDay',
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
