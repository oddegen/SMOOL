<?php

namespace App\Filament\Student\Resources\AssignmentSubmissionResource\Pages;

use App\Filament\Student\Resources\AssignmentSubmissionResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListAssignmentSubmissions extends ListRecords
{
    protected static string $resource = AssignmentSubmissionResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
