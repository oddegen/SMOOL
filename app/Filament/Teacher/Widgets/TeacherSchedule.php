<?php

namespace App\Filament\Teacher\Widgets;

use App\Models\Schedule;
use Filament\Actions\Action;
use Filament\Actions\ViewAction;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\TextInput;
use Filament\Widgets\Widget;
use Illuminate\Database\Eloquent\Model;
use Saade\FilamentFullCalendar\Data\EventData;
use Saade\FilamentFullCalendar\Widgets\FullCalendarWidget;

class TeacherSchedule extends FullCalendarWidget
{
    protected int | string | array $columnSpan = 2;

    public Model | string | null $model = Schedule::class;

    public function fetchEvents(array $fetchInfo): array
    {
        return Schedule::query()
            ->where('user_id', auth()->user()->id)
            ->where('starts_at', '>=', $fetchInfo['start'])
            ->where('ends_at', '<=', $fetchInfo['end'])
            ->get()
            ->map(
                fn(Schedule $schedule) => EventData::make()
                    ->id($schedule->id)
                    ->title($schedule->subject->name)
                    ->start($schedule->starts_at)
                    ->end($schedule->ends_at)
            )
            ->toArray();
    }

    public function getFormSchema(): array
    {
        return [
            TextInput::make('title')
                ->required()
                ->maxLength(255),
            DateTimePicker::make('starts_at')
                ->required(),
            DateTimePicker::make('ends_at')
                ->required()
        ];
    }

    public function viewAction(): Action
    {
        return ViewAction::make();
    }

    protected function headerActions(): array
    {
        return [];
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
