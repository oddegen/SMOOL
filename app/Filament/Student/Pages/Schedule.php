<?php

namespace App\Filament\Student\Pages;

use Filament\Pages\Page;
use Filament\Resources\Pages\Concerns\InteractsWithRecord;

class Schedule extends Page
{
    protected static ?string $navigationIcon = 'heroicon-o-document-text';

    protected static string $view = 'filament.student.pages.schedule';

    protected static ?string $title = 'Schedule';
}
