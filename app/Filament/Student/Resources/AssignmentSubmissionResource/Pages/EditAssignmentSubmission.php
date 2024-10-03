<?php

namespace App\Filament\Student\Resources\AssignmentSubmissionResource\Pages;

use App\Filament\Student\Resources\AssignmentSubmissionResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditAssignmentSubmission extends EditRecord
{
    protected static string $resource = AssignmentSubmissionResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\ViewAction::make(),
            Actions\DeleteAction::make(),
        ];
    }
}
