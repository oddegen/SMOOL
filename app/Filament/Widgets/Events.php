<?php

namespace App\Filament\Widgets;

use App\Filament\Resources\EventResource;
use App\Models\Event;
use DragonCode\Support\Facades\Instances\Call;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\TextInput;
use Filament\Widgets\Widget;
use Illuminate\Database\Eloquent\Model;
use Saade\FilamentFullCalendar\Data\EventData;
use Saade\FilamentFullCalendar\Widgets\FullCalendarWidget;

class Events extends FullCalendarWidget
{
    protected int | string | array $columnSpan = '2';

    public Model | string | null $model = Event::class;

    public function fetchEvents(array $fetchInfo): array
    {
        return Event::query()
            ->where('is_announcement', false)
            ->where('start_date', '>=', $fetchInfo['start'])
            ->where('end_date', '<=', $fetchInfo['end'])
            ->get()
            ->map(
                fn(Event $event) => EventData::make()
                    ->id($event->id)
                    ->title($event->title)
                    ->start($event->start_date)
                    ->end($event->end_date)
                    ->url(
                        url: EventResource::getUrl(name: 'view', parameters: ['record' => $event]),
                        shouldOpenUrlInNewTab: true
                    )
            )
            ->toArray();
    }

    public function getFormSchema(): array
    {
        return [];
    }

    protected function headerActions(): array
    {
        return [];
    }

    public function config(): array
    {
        return [
            'initialView' => 'dayGridWeek',
            'headerToolbar' => [
                'left' => 'prev,next',
                'center' => 'title',
                'right' => 'dayGridWeek,dayGridDay',
            ],
            'titleFormat' => [
                'month' => 'short',
                'day' => 'numeric'
            ],
            'dayHeaderFormat' =>
            [
                'weekday' => 'short'
            ],
            'eventMinHeight' => 50,
            'weekends' => false,
            'allDaySlot' => false,
            'scrollTimeReset' => false,
        ];
    }
}
