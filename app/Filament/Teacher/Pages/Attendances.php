<?php

namespace App\Filament\Teacher\Pages;

use App\Models\Attendance;
use Filament\Forms\Get;
use Filament\Forms\Set;
use Filament\Pages\Page;
use Filament\Tables\Actions\Action;
use Illuminate\Support\Facades\Auth;
use Filament\Tables\Concerns\InteractsWithTable;
use Filament\Tables\Table;
use Filament\Tables\Contracts\HasTable;
use Filament\Tables\Grouping\Group;
use Illuminate\Database\Eloquent\Builder;

class Attendances extends Page implements HasTable
{
    use InteractsWithTable;
    protected static ?string $navigationIcon = 'heroicon-o-document-text';

    protected static string $view = 'filament.teacher.pages.attendances';
    protected static ?string $navigationLabel = 'Take Attendance';

    protected function getTableQuery()
    {
        return Attendance::query()
            ->whereHas('section', function ($query) {
                $query->whereHas('sectionUsers', function ($query) {
                    $query->where('teacher_id', Auth::user()->id);
                });
            })
            ->whereDate('time', now()->toDateString());
    }

    protected function table(Table $table): Table
    {
        return $table->query($this->getTableQuery())
            ->columns([
                \Filament\Tables\Columns\TextColumn::make('section.name')
                    ->label('Section')
                    ->badge()
                    ->searchable(),
                \Filament\Tables\Columns\TextColumn::make('student.name')
                    ->label('Student Name')
                    ->searchable(),
                \Filament\Tables\Columns\IconColumn::make('status')
                    ->label('Status')
                    ->icon(fn(string $state): string => match ($state) {
                        'present' => 'heroicon-o-check',
                        'absent' => 'heroicon-o-x-mark',
                        default => 'heroicon-o-question-mark-circle',
                    })
                    ->action(function ($record, $state) {
                        $newStatus = match ($state) {
                            'present' => 'absent',
                            'absent' => 'present',
                            default => 'present',
                        };

                        Attendance::where('id', $record->id)->update(['status' => $newStatus]);
                    }),
            ])
            ->groups([
                Group::make('section.name')
                    ->label('Section')
                    ->collapsible()
                    ->titlePrefixedWithLabel(false)
                    ->groupQueryUsing(fn(Builder $query) => $query->groupBy('student_id')),
            ])
            ->defaultGroup('section.name')
            ->defaultSort('id')
            ->emptyStateIcon('heroicon-o-document-text')
            ->emptyStateDescription('No attendance records found.');
    }
}
