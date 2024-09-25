<?php

namespace App\Filament\Teacher\Resources\TeacherSubjectResource\Pages;

use App\Filament\Teacher\Resources\TeacherSubjectResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;
use Filament\Tables\Table;

class ListTeacherSubjects extends ListRecords
{
    protected static string $resource = TeacherSubjectResource::class;

    protected function getHeaderActions(): array
    {
        return [];
    }
}
