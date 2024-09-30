<?php

namespace App\Filament\Teacher\Resources\GradeComponentResource\Pages;

use App\Filament\Teacher\Resources\GradeComponentResource;
use Filament\Actions;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class CreateGradeComponent extends CreateRecord
{
    protected static string $resource = GradeComponentResource::class;

    protected function beforeCreate(): void
    {
        $total = collect($this->data['components'])->sum('weight');
        if ($total !== 100) {
            Notification::make()
                ->warning()
                ->title('The total weight of all components must equal 100%.')
                ->body('Please adjust the weights of the components and try again.')
                ->persistent()
                ->send();

            $this->halt();
        }
    }

    protected function handleRecordCreation(array $data): Model
    {

        $components = $data['components'];
        $subjectId = $data['subject_id'];
        $teacherId = Auth::user()->id;

        foreach ($components as $component) {
            static::getModel()::create([
                'name' => $component['name'],
                'weight' => $component['weight'],
                'subject_id' => $subjectId,
                'teacher_id' => $teacherId,
            ]);
        }

        return static::getModel()::where('subject_id', $subjectId)
            ->where('teacher_id', $teacherId)
            ->first();
    }

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
