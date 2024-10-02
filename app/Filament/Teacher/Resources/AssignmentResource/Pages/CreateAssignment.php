<?php

namespace App\Filament\Teacher\Resources\AssignmentResource\Pages;

use App\Filament\Teacher\Resources\AssignmentResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;
use App\Models\Section;
use Filament\Notifications\Notification;
use Filament\Notifications\Actions\Action;

class CreateAssignment extends CreateRecord
{
    protected static string $resource = AssignmentResource::class;

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $data['teacher_id'] = auth()->user()->id;

        return $data;
    }

    protected function afterCreate(): void
    {
        $assignment = $this->record;
        $section = Section::find($assignment->section_id);

        $students = $section->sectionUsers()
            ->where('year', now()->year)
            ->pluck('student_id')
            ->map(function ($studentId) {
                return \App\Models\User::find($studentId);
            });

        Notification::make()
            ->title('New Assignment Created')
            ->body("A new assignment '{$assignment->title}' has been created for section {$section->name}.")
            ->actions([
                Action::make('view')
                    ->button()
                    ->markAsRead(),
            ])
            ->sendToDatabase(
                $students
            );
    }

    protected function getCreatedNotification(): ?Notification
    {
        return Notification::make()
            ->success()
            ->title('Assignment Created')
            ->body('The assignment has been created and students have been notified.')
            ->send();
    }
}
