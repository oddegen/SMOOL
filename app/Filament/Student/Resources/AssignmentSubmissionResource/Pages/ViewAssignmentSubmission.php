<?php

namespace App\Filament\Student\Resources\AssignmentSubmissionResource\Pages;

use App\Filament\Student\Resources\AssignmentSubmissionResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewAssignmentSubmission extends ViewRecord
{
    protected static string $resource = AssignmentSubmissionResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make()
                ->visible(fn($record) => $record->canSubmit()),
        ];
    }
}
