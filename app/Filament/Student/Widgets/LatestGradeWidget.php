<?php

namespace App\Filament\Student\Widgets;

use App\Models\Grade;
use App\Models\Subject;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget as BaseWidget;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\DB;

class LatestGradeWidget extends BaseWidget
{
    protected int | string | array $columnSpan = '1';

    public function table(Table $table): Table
    {
        return $table
            ->query(
                $this->getLatestGrades()
            )
            ->columns([
                Tables\Columns\TextColumn::make('subject.name')
                    ->label('Subject')
                    ->description(fn($record) => $record->grade_component->name ?? ''),
                Tables\Columns\TextColumn::make('score')
                    ->label('Score')
                    ->formatStateUsing(fn($state) => number_format($state, 2)),
            ])
            ->paginated(false);
    }

    protected function getLatestGrades()
    {
        return Grade::query()
            ->where('student_id', auth()->id())
            ->orderBy('updated_at', 'desc')
            ->limit(5);
    }
}
