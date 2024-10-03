<?php

namespace App\Filament\Student\Resources;

use App\Filament\Student\Resources\AssignmentSubmissionResource\Pages;
use App\Models\AssignmentSubmission;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;

class AssignmentSubmissionResource extends Resource
{
    protected static ?string $model = AssignmentSubmission::class;

    protected static ?string $navigationIcon = 'heroicon-o-document-text';

    protected static ?string $navigationGroup = 'Academic';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('assignment_id')
                    ->relationship('assignment', 'title', modifyQueryUsing: fn(Builder $query) => $query->where('status', 'published')->where('due_date', '>', now()))
                    ->required()
                    ->disabled(fn($record) => $record !== null),
                Forms\Components\MarkdownEditor::make('content')
                    ->required()
                    ->columnSpanFull()
                    ->disabled(fn($record) => $record && !$record->canSubmit()),
                Forms\Components\FileUpload::make('file_path')
                    ->label('Attachment')
                    ->directory('assignment-submissions')
                    ->disabled(fn($record) => $record && !$record->canSubmit()),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('assignment.title')
                    ->searchable(),
                Tables\Columns\TextColumn::make('submitted_at')
                    ->dateTime()
                    ->sortable(),
                Tables\Columns\TextColumn::make('grade')
                    ->sortable(),
                Tables\Columns\IconColumn::make('feedback')
                    ->boolean()
                    ->trueIcon('heroicon-o-check-circle')
                    ->falseIcon('heroicon-o-x-circle'),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make()
                    ->visible(fn($record) => $record->canSubmit()),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    //
                ]),
            ])
            ->modifyQueryUsing(fn(Builder $query) => $query->where('student_id', auth()->user()->id));
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListAssignmentSubmissions::route('/'),
            'create' => Pages\CreateAssignmentSubmission::route('/create'),
            'view' => Pages\ViewAssignmentSubmission::route('/{record}'),
            'edit' => Pages\EditAssignmentSubmission::route('/{record}/edit'),
        ];
    }
}
