<?php

namespace App\Filament\Teacher\Widgets;

use App\Models\AssignmentSubmission;
use Filament\Support\Enums\Alignment;
use Filament\Tables;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget as BaseWidget;
use Illuminate\Database\Eloquent\Builder;

class LatestSubmissions extends BaseWidget
{

    protected int | string | array $columnSpan = '1';


    public function table(Table $table): Table
    {
        return $table
            ->query(
                AssignmentSubmission::query()
                    ->whereHas('assignment', function (Builder $query) {
                        $query->where('teacher_id', auth()->id());
                    })
                    ->latest('submitted_at')
                    ->limit(10)
            )
            ->columns([
                ImageColumn::make('student.avatar_url')
                    ->label('Student')
                    ->circular(),
                Tables\Columns\TextColumn::make('student.name')
                    ->label('Student')
                    ->alignment(Alignment::Start),
                Tables\Columns\TextColumn::make('assignment.title')
                    ->label('Assignment')
            ])
            ->paginated(false);
    }
}
