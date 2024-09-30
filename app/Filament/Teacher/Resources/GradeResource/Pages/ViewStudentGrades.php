<?php

namespace App\Filament\Teacher\Resources\GradeResource\Pages;

use App\Filament\Teacher\Resources\GradeResource;
use App\Models\Grade;
use App\Models\GradeComponent;
use App\Models\Subject;
use Filament\Forms\Components\Group as ComponentsGroup;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Form;
use Filament\Infolists\Components\Grid;
use Filament\Infolists\Components\Group;
use Filament\Infolists\Components\ImageEntry;
use Filament\Resources\Pages\Page;
use Filament\Infolists\Infolist;
use Filament\Infolists\Components\Section;
use Filament\Infolists\Components\TextEntry;
use Filament\Infolists\Components\RepeatableEntry;
use Filament\Infolists\Concerns\InteractsWithInfolists;
use Filament\Infolists\Contracts\HasInfolists;
use Filament\Resources\Pages\Concerns\InteractsWithRecord;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\TextInputColumn;
use Filament\Tables\Concerns\InteractsWithTable;
use Filament\Tables\Contracts\HasTable;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\HtmlString;

class ViewStudentGrades extends Page implements HasForms, HasInfolists, HasTable
{
    use InteractsWithRecord, InteractsWithForms, InteractsWithInfolists, InteractsWithTable;

    public ?array $data;

    protected static string $resource = GradeResource::class;

    protected static string $view = 'filament.teacher.resources.grade-resource.pages.view-student-grades';

    public function mount(int | string $record): void
    {
        $this->record = $this->resolveRecord($record);

        $this->form->fill();
    }

    public function infolist(Infolist $infolist): Infolist
    {
        return $infolist
            ->record($this->record)
            ->schema([
                Group::make()
                    ->schema([
                        Grid::make(2)
                            ->schema([
                                ImageEntry::make('avatar_url')
                                    ->label('Profile Picture'),
                                Group::make()
                                    ->schema([
                                        TextEntry::make('name')
                                            ->formatStateUsing(fn($record) => $record->getFullNameAttribute())
                                            ->label('FullName'),
                                        TextEntry::make('email')
                                            ->label('Email'),
                                    ])
                            ]),
                    ]),
            ]);
    }

    public function table(Table $table): Table
    {
        $studentId = $this->record->id;
        $teacherId = Auth::user()->id;

        // Get all grade components for subjects taught by the current teacher
        $gradeComponents = GradeComponent::whereHas('subject', function ($query) use ($teacherId) {
            $query->whereHas('teachers', function ($query) use ($teacherId) {
                $query->where('teacher_id', $teacherId);
            });
        })->get();

        // Create or get grades for each component
        $grades = $gradeComponents->map(function ($component) use ($studentId, $teacherId) {
            return Grade::firstOrCreate([
                'subject_id' => $component->subject_id,
                'student_id' => $studentId,
                'grade_component_id' => $component->id,
                'teacher_id' => $teacherId,
                'grading_period' => '1st Grading Period',
            ], [
                'score' => 0, // Default score
            ]);
        });

        return $table
            ->query(Grade::query()->whereIn('id', $grades->pluck('id')))
            ->columns([
                TextColumn::make('gradeComponent.name')
                    ->label('Component'),
                TextColumn::make('gradeComponent.weight')
                    ->label('Weight (%)')
                    ->formatStateUsing(fn($state) => number_format($state, 2) . '%'),
                TextInputColumn::make('score')
                    ->label('Score')
                    ->step(0.01)
                    ->default(0)
            ])
            ->filters([
                SelectFilter::make('grading_period')
                    ->label('Grading Period')
                    ->options([
                        '1st Grading Period' => '1st Grading Period',
                        '2nd Grading Period' => '2nd Grading Period',
                        '3rd Grading Period' => '3rd Grading Period',
                    ]),
            ]);
    }

    protected function getHeaderActions(): array
    {
        return [
            // Add any actions you want in the header
        ];
    }
}
