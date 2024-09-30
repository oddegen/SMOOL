<?php

namespace App\Filament\Teacher\Resources;

use App\Filament\Teacher\Resources\GradeComponentResource\Pages;
use App\Models\GradeComponent;
use App\Models\Subject;
use Closure;
use Filament\Actions\Action;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Forms\Get;
use Filament\Forms\Set;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Grouping\Group;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rules\Unique;
use Illuminate\Validation\ValidationException;

class GradeComponentResource extends Resource
{
    protected static ?string $model = GradeComponent::class;

    protected static ?string $navigationIcon = 'heroicon-o-calculator';

    protected static ?string $navigationLabel = 'Grading Components';

    protected static ?string $navigationGroup = 'Academic';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('subject_id')
                    ->label('Subject')
                    ->options(function () {
                        return Subject::whereHas('teachers', function ($query) {
                            $query->where('user_id', Auth::id());
                        })->pluck('name', 'id');
                    })
                    ->required(),
                Forms\Components\Repeater::make('components')
                    ->schema([
                        Forms\Components\TextInput::make('name')
                            ->distinct()
                            ->required()
                            ->maxLength(255),
                        Forms\Components\TextInput::make('weight')
                            ->numeric()
                            ->required()
                            ->minValue(0)
                            ->maxValue(100),
                    ])
                    ->addActionLabel('Add Grading Component')
                    ->columns(2)
                    ->defaultItems(1)
                    ->minItems(1)
                    ->live()
                    ->afterStateUpdated(function ($state, Set $set) {
                        $total = collect($state)->sum(function ($item) {
                            return is_numeric($item['weight']) ? $item['weight'] : 0;
                        });
                        $set('total_weight', $total);
                    }),
                Forms\Components\Placeholder::make('total_weight')
                    ->label('Total Weight')
                    ->content(function ($state) {
                        $state ??= 0;
                        return "{$state}%";
                    }),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('subject.name')
                    ->sortable(),
                Tables\Columns\TextColumn::make('name')
                    ->searchable(),
                Tables\Columns\TextColumn::make('weight')
                    ->sortable(),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('subject')
                    ->relationship('subject', 'name'),
            ])
            ->actions([
                Tables\Actions\Action::make('edit')
                    ->icon('heroicon-o-pencil-square')
                    ->url(fn(GradeComponent $record): string => static::getUrl('edit', ['record' => $record]))
                    ->hidden(fn(GradeComponent $record): bool => $record->subject->gradingComponents()->first()->id !== $record->id),
            ])
            ->defaultGroup('subject.name')
            ->groups([
                Group::make('subject.name')
                    ->collapsible()
                    ->titlePrefixedWithLabel(false)
            ])
            ->bulkActions([]);
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
            'index' => Pages\ListGradeComponents::route('/'),
            'create' => Pages\CreateGradeComponent::route('/create'),
            'edit' => Pages\EditGradeComponent::route('/{record}/edit'),
        ];
    }

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()
            ->where('teacher_id', Auth::user()->id)
            ->where('school_year', now()->year);
    }
}
