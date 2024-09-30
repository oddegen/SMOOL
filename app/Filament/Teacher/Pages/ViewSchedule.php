<?php

namespace App\Filament\Teacher\Pages;

use App\Filament\Widgets\CalendarWidget;
use Filament\Pages\Page;

class ViewSchedule extends Page
{
    protected static ?string $navigationIcon = 'heroicon-o-document-text';

    protected static string $view = 'filament.teacher.pages.view-schedule';
}
