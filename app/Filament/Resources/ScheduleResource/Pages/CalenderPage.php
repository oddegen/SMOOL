<?php

namespace App\Filament\Resources\ScheduleResource\Pages;

use App\Filament\Resources\ScheduleResource;
use App\Filament\Widgets\CalendarWidget;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\Page;

class CalenderPage extends Page
{
    protected static string $resource = ScheduleResource::class;

    protected static string $view = 'filament.resources.schedule-resource.pages.calender-page';

    protected static ?string $title = 'TimeTable';
}
