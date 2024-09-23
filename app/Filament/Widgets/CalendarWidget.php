<?php

namespace App\Filament\Widgets;

use App\Models\Schedule;
use App\Models\User;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
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
            TextInput::make('name'),
            Grid::make()
                ->schema([
                    DateTimePicker::make('starts_at'),
                    DateTimePicker::make('ends_at'),
                ]),
            Select::make('batch_id')
                ->relationship('batches', 'name')
                ->searchable()
                ->required(),
            Select::make('user_id')
                ->label('Teacher')
                ->relationship(
                    'user',
                    'name',
                    // modifyQueryUsing: function (Builder $query): Builder {
                    // $user = User::with('role')->where('user.role', 'Teacher')->get();
                    // return $query->whereBelongsTo($user);
                    // }
                )
                ->searchable()
                ->required(),
        ];
    }
}
