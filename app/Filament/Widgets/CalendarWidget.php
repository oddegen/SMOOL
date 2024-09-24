<?php

namespace App\Filament\Widgets;

use App\Filament\Resources\ScheduleResource;
use App\Models\Batch;
use App\Models\Role;
use App\Models\Schedule;
use App\Models\Section;
use App\Models\Subject;
use App\Models\User;
use Filament\Actions\CreateAction;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Get;
use Filament\Widgets\Widget;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Saade\FilamentFullCalendar\Widgets\FullCalendarWidget;

class CalendarWidget extends FullCalendarWidget
{
    public Model | string | null $model = Schedule::class;

    public function getFormSchema(): array
    {
        return [
            Select::make('user_id')
                ->label('Teacher')
                ->relationship(
                    'user',
                    'name',
                    modifyQueryUsing: function (Builder $query) {
                        return $query->whereBelongsTo(Role::where('name', 'Teacher')->first());
                    }
                )
                ->searchable()
                ->required()
                ->preload()
                ->live(),
            Select::make('subject_id')
                ->relationship('subject', 'name')
                ->options(
                    function (Get $get) {
                        $user = $get('user_id');
                        $subjects = Subject::whereHas('teachers', function (Builder $query) use ($user) {
                            $query->where('user_id', $user);
                        })->get();

                        return $subjects->pluck('name', 'id');
                    }
                )
                ->searchable()
                ->required()
                ->native(false)
                ->preload()
                ->visible(fn(Get $get) => filled($get('user_id'))),
            Grid::make()
                ->schema([
                    DateTimePicker::make('starts_at'),
                    DateTimePicker::make('ends_at'),
                ]),
            Select::make('batch_id')
                ->relationship('batch', 'name')
                ->searchable()
                ->required()
                ->native(false)
                ->live()
                ->preload(),
            Select::make('section_id')
                ->relationship('section', 'name')
                ->native(false)
                ->preload()
                ->options(function (Get $get) {
                    $batchId = $get('batch_id');
                    if (!$batchId) {
                        return [];
                    }
                    $sections = Section::whereHas('batches', function (Builder $query) use ($batchId) {
                        $query->where('batch_id', $batchId);
                    })->get();
                    return $sections->pluck('name', 'id');
                })
                ->visible(fn(Get $get) => filled($get('batch_id'))),
        ];
    }

    public function fetchEvents(array $fetchInfo): array
    {
        return Schedule::query()
            ->where('starts_at', '>=', $fetchInfo['start'])
            ->where('ends_at', '<=', $fetchInfo['end'])
            ->get()
            ->map(
                fn(Schedule $event) => [
                    'id' => $event->id,
                    'title' => $event->subject()->first()->name,
                    'teacher' => $event->user()->first()->name,
                    'start' => $event->starts_at,
                    'end' => $event->ends_at,
                ]
            )
            ->all();
    }
}
