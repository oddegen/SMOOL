<?php

namespace App\Filament\Resources\ScheduleResource\Pages;

use App\Filament\Resources\ScheduleResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListSchedule extends ListRecords
{
    protected static string $resource = ScheduleResource::class;

    protected static string $view = 'filament.widgets.calendar-widget';

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
