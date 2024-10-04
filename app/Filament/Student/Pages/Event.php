<?php

namespace App\Filament\Student\Pages;

use Filament\Pages\Page;
use Filament\Tables\Concerns\InteractsWithTable;
use Filament\Tables\Contracts\HasTable;
use Filament\Tables\Table;
use App\Models\Event as EventModel;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;

class Event extends Page implements HasTable
{
    use InteractsWithTable;

    protected static ?string $navigationIcon = 'heroicon-o-document-text';

    protected static string $view = 'filament.student.pages.event';

    protected static ?string $title = 'Events';

    public function table(Table $table): Table
    {
        return $table
            ->query(EventModel::query())
            ->columns([
                TextColumn::make('title')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('start_date')
                    ->date('F j, Y')
                    ->sortable(),
                TextColumn::make('end_date')
                    ->date('F j, Y')
                    ->sortable(),
                TextColumn::make('location')
                    ->searchable(),
                IconColumn::make('is_announcement')
                    ->boolean(),
            ])
            ->filters([
                // Add filters here if needed
            ])
            ->actions([
                // Add actions here if needed
            ])
            ->bulkActions([
                // Add bulk actions here if needed
            ])
            ->modifyQueryUsing(fn($query) => $query->whereHas('sections', fn($query) => $query->whereHas('sectionUsers', fn($query) => $query->where('student_id', auth()->user()->id))));
    }
}
