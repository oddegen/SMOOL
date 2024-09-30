<?php

namespace App\Filament\Teacher\Resources\GradeComponentResource\Pages;

use App\Filament\Teacher\Resources\GradeComponentResource;
use App\Models\GradeComponent;
use App\Models\Subject;
use Filament\Actions;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\EditRecord;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class EditGradeComponent extends EditRecord
{
    protected static string $resource = GradeComponentResource::class;

    public $subject;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }

    protected function mutateFormDataBeforeFill(array $data): array
    {
        $gradeComponent = GradeComponent::findOrFail($this->record->id);

        $this->subject = $gradeComponent->subject;
        $components = $this->subject->gradingComponents()
            ->where('teacher_id', Auth::user()->id)
            ->get();

        return [
            'subject_id' => $this->subject->id,
            'components' => $components->map(function ($component) {
                return [
                    'name' => $component->name,
                    'weight' => $component->weight,
                ];
            })->toArray(),
        ];
    }

    protected function handleRecordUpdate(Model $record, array $data): Model
    {
        $components = $data['components'];


        $this->subject->gradingComponents()->delete();

        foreach ($components as $component) {
            $this->subject->gradingComponents()->create([
                'name' => $component['name'],
                'weight' => $component['weight'],
                'teacher_id' => Auth::user()->id,
            ]);
        }

        return $this->record;
    }

    protected function beforeSave(): void
    {
        $total = collect($this->data['components'])->sum('weight');
        if ($total !== 100.00) {
            Notification::make()
                ->warning()
                ->title('The total weight of all components must equal 100%.')
                ->body('Please adjust the weights of the components and try again.')
                ->persistent()
                ->send();

            $this->halt();
        }
    }

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
