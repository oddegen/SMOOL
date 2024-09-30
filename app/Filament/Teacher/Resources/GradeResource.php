<?php

namespace App\Filament\Teacher\Resources;

use App\Filament\Teacher\Resources\GradeResource\Pages;
use App\Filament\Teacher\Resources\GradeResource\RelationManagers;
use App\Models\Grade;
use App\Models\User;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;

class GradeResource extends Resource
{
    protected static ?string $model = Grade::class;

    protected static ?string $navigationIcon = 'heroicon-o-academic-cap';

    protected static ?string $navigationLabel = 'Student Grades';

    protected static ?string $navigationGroup = 'Academic';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                // We'll leave this empty as we're not editing grades directly
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->formatStateUsing(fn($record) => $record->getFullNameAttribute())
                    ->label('Student Name')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('email')
                    ->label('Student Email')
                    ->searchable()
                    ->sortable(),
            ])
            ->filters([
                //
            ])
            ->actions([])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    //
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            RelationManagers\GradesRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListGrades::route('/'),
            'view' => Pages\ViewStudentGrades::route('/{record}'),
        ];
    }

    public static function getEloquentQuery(): Builder
    {
        return User::query()
            ->whereHas('role', function ($query) {
                $query->where('name', 'Student');
            })
            ->whereHas('sectionUsers', function ($query) {
                $query->where('teacher_id', Auth::id());
            });
    }
}
