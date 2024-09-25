<?php

namespace App\Filament\Teacher\Pages;

use Filament\Pages\Page;
use Illuminate\Support\Facades\Auth;
use Filament\Tables\Concerns\InteractsWithTable;
use Filament\Tables\Table;
use Filament\Tables\Contracts\HasTable;


class Attendances extends Page implements HasTable
{
    use InteractsWithTable;
    protected static ?string $navigationIcon = 'heroicon-o-document-text';

    protected static string $view = 'filament.teacher.pages.attendances';
    protected static ?string $navigationLabel = 'Take Attendance';

    public function mount()
    {
        $this->createAttendanceRecords();
    }

    protected function getTableQuery()
    {
        return \App\Models\Attendance::query()
            ->whereHas('section', function ($query) {
                $query->whereHas('sectionUsers', function ($query) {
                    $query->where('teacher_id', Auth::id());
                });
            })
            ->whereDate('time', now()->toDateString());
    }

    protected function table(Table $table): Table
    {
        return $table->query($this->getTableQuery())
            ->columns([
                \Filament\Tables\Columns\TextColumn::make('student.name')
                    ->label('Student Name'),
                \Filament\Tables\Columns\TextColumn::make('section.name')
                    ->label('Section'),
                \Filament\Tables\Columns\IconColumn::make('is_present')
                    ->boolean()
                    ->label('Present')
                    ->action(
                        \Filament\Tables\Actions\Action::make('toggleAttendance')
                            ->icon(fn($record) => $record->is_present ? 'heroicon-o-x-mark' : 'heroicon-o-check')
                            ->action(function ($record) {
                                $record->update(['is_present' => !$record->is_present]);
                            })
                    )
            ]);
    }

    protected function getTableActions()
    {
        return [];
    }

    protected function getTableBulkActions()
    {
        return [];
    }

    private function createAttendanceRecords()
    {
        \App\Jobs\CreateDailyAttendanceRecords::dispatch(auth()->user());
    }
}
