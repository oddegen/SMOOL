<?php

namespace App\Filament\Clusters\Classes\Resources\SectionResource\Widgets;

use App\Models\Role;
use App\Models\Schedule;
use App\Models\Subject;
use App\Models\User;
use Carbon\Carbon;
use Filament\Actions\Concerns\InteractsWithActions;
use Filament\Actions\Contracts\HasActions;
use Filament\Actions\CreateAction;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Form;
use Filament\Notifications\Notification;
use Illuminate\Database\Eloquent\Model;
use Saade\FilamentFullCalendar\Widgets\FullCalendarWidget;

class CalendarWidget extends FullCalendarWidget implements HasForms, HasActions
{
    use InteractsWithForms;
    use InteractsWithActions;

    public Model | string | null $section = null;

    public Model | string | null $model = Schedule::class;

    public function getFormSchema(): array
    {
        return [
            Select::make('subject_id')
                ->label('Subject')
                ->options(
                    Subject::all()->pluck('name', 'id')
                )
                ->required(),
            Select::make('user_id')
                ->label('Teacher')
                ->options(
                    User::where('role_id', Role::where('name', 'Teacher')->first()->id)
                        ->get()->pluck('name', 'id')
                )
                ->required(),
            DateTimePicker::make('starts_at')
                ->label('Starts At')
                ->required(),
            DateTimePicker::make('ends_at')
                ->label('Ends At')
                ->required(),
        ];
    }

    public function fetchEvents(array $fetchInfo): array
    {
        return Schedule::whereBelongsTo($this->section)
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

    protected function headerActions(): array
    {
        return [
            CreateAction::make()
                ->before(function (CreateAction $action, array $data) {
                    // Create a temporary Schedule instance with the form data
                    $tempSchedule = new Schedule($data);
                    $tempSchedule->section_id = $this->section->id;

                    if ($tempSchedule->hasOverlap()) {
                        Notification::make()
                            ->title('Error')
                            ->body('The schedule overlaps with an existing schedule.')
                            ->danger()
                            ->send();

                        $action->halt();
                    }
                })
                ->model($this->model)
                ->form($this->getFormSchema())
                ->mutateFormDataUsing(function (array $data): array {
                    $data['section_id'] = $this->section->id;
                    $data['batch_id'] = $this->section->batches()->where('year', date('Y'))->first()->id;
                    return $data;
                })
                ->successRedirectUrl(route('filament.admin.classes.resources.sections.schedule', ['record' => $this->section]))
                ->mountUsing(
                    function (Form $form, array $arguments) {
                        $form->fill([
                            'starts_at' => $arguments['start'] ?? null,
                            'ends_at' => $arguments['end'] ?? null
                        ]);
                    }
                ),
        ];
    }
}
