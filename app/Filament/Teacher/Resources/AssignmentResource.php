<?php

namespace App\Filament\Teacher\Resources;

use App\Filament\Teacher\Resources\AssignmentResource\Pages;
use App\Filament\Teacher\Resources\AssignmentResource\RelationManagers;
use App\Models\Assignment;
use Filament\Forms;
use Filament\Forms\Components\MarkdownEditor;
use Filament\Forms\Components\ToggleButtons;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Teacher\Resources\AssignmentResource\RelationManagers\SubmissionsRelationManager;

class AssignmentResource extends Resource
{
    protected static ?string $model = Assignment::class;

    protected static ?string $navigationIcon = 'heroicon-o-pencil-square';

    protected static ?string $navigationGroup = 'Academic';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('title')
                    ->required()
                    ->maxLength(255),
                MarkdownEditor::make('description')
                    ->columnSpanFull(),
                Forms\Components\Select::make('section_id')
                    ->relationship('section', 'name', modifyQueryUsing: fn(Builder $query) => $query->where('teacher_id', auth()->user()->id))
                    ->required(),
                Forms\Components\DatePicker::make('due_date')
                    ->required(),
                ToggleButtons::make('status')
                    ->label('Status')
                    ->options([
                        'draft' => 'Draft',
                        'published' => 'Published',
                        'archived' => 'Archived',
                    ])
                    ->icons([
                        'draft' => 'heroicon-o-pencil',
                        'published' => 'heroicon-o-check-circle',
                        'archived' => 'heroicon-o-archive-box-arrow-down',
                    ])
                    ->inline()
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('title')
                    ->searchable(),
                Tables\Columns\TextColumn::make('due_date')
                    ->date()
                    ->sortable(),
                Tables\Columns\IconColumn::make('status')
                    ->icon(fn(string $state): string => match ($state) {
                        'draft' => 'heroicon-o-pencil',
                        'published' => 'heroicon-o-check-circle',
                        'archived' => 'heroicon-o-archive-box-arrow-down',
                        default => 'heroicon-o-question-mark-circle',
                    }),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('status')
                    ->options([
                        'draft' => 'Draft',
                        'published' => 'Published',
                        'archived' => 'Archived',
                    ])
                    ->label('Status')
                    ->multiple()
                    ->placeholder('All Statuses'),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ])
            ->modifyQueryUsing(fn(Builder $query) => $query->where('teacher_id', auth()->user()->id));
    }

    public static function getRelations(): array
    {
        return [
            SubmissionsRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListAssignments::route('/'),
            'create' => Pages\CreateAssignment::route('/create'),
            'edit' => Pages\EditAssignment::route('/{record}/edit'),
        ];
    }
}
