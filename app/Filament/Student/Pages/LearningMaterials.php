<?php

namespace App\Filament\Student\Pages;

use Filament\Actions\Action;
use Filament\Actions\Concerns\InteractsWithActions;
use Filament\Actions\Contracts\HasActions;
use Filament\Pages\Page;
use App\Models\GeneratedResource;
use App\Models\User;
use App\Services\MarkdownParser;
use Gemini\Laravel\Facades\Gemini;
use Parsedown;

class LearningMaterials extends Page implements HasActions
{
    use InteractsWithActions;
    protected static ?string $navigationIcon = 'heroicon-o-document-text';

    protected static string $view = 'filament.student.pages.learning-materials';

    protected ?string $heading = 'Learning Materials';

    protected ?string $subheading = 'AI-powered tool to generate personalized learning materials and study guides';

    public $generatedContent = null;

    public function mount(): void
    {
        $this->generatedContent = app(MarkdownParser::class)->parse(GeneratedResource::where('user_id', auth()->id())
            ->latest()
            ->first()?->content);
    }

    public function generateAction(): Action
    {
        return Action::make('generate')
            ->label('Generate')
            ->icon('heroicon-o-sparkles')
            ->action(fn() => $this->generate());
    }

    public function generate(): void
    {
        $user = User::find(auth()->id());
        $grades = $user->studentGrades()
            ->whereYear('created_at', now()->year)
            ->with('subject')
            ->get()
            ->groupBy('subject.name')
            ->map(function ($subjectGrades) {
                return [
                    'subject' => $subjectGrades->first()->subject->name,
                    'score' => $subjectGrades->sum('score')
                ];
            })
            ->values();
        $batch = $user->sectionUsers()->currentYear()->first()->section->batches()->wherePivot('year', now()->year)->first();


        $content = Gemini::geminiPro()->generateContent(
            'Create a personalized study guide for me. I\'m in batch ' . $batch->name . ' and here are my subjects and grades: ' . $grades->map(function ($grade) {
                return sprintf(
                    "Subject: %s, Grade: %s",
                    $grade['subject'],
                    $grade['score'],
                );
            })->implode('; ')
        );

        GeneratedResource::create([
            'user_id' => auth()->id(),
            'content' => $content->text(),
        ]);

        $this->generatedContent = app(MarkdownParser::class)->parse($content->text());
    }
}
