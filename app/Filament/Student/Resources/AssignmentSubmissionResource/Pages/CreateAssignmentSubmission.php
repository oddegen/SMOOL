<?php

namespace App\Filament\Student\Resources\AssignmentSubmissionResource\Pages;

use App\Filament\Student\Resources\AssignmentSubmissionResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateAssignmentSubmission extends CreateRecord
{
    protected static string $resource = AssignmentSubmissionResource::class;

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $data['student_id'] = auth()->user()->id;
        $data['submitted_at'] = now();

        return $data;
    }
}
