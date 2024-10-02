<?php

namespace App\Filament\Student\Resources\GradeResource\Pages;

use App\Filament\Student\Resources\GradeResource;
use Filament\Actions;
use Filament\Resources\Pages\ManageRecords;
use Illuminate\Database\Eloquent\Model;

class ManageGrades extends ManageRecords
{
    protected static string $resource = GradeResource::class;

    protected function getHeaderActions(): array
    {
        return [];
    }
}
