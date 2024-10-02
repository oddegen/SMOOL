<?php

namespace App\Filament\Student\Resources;

use App\Filament\Student\Resources\GradeResource\Pages;
use App\Filament\Student\Resources\GradeResource\RelationManagers;
use App\Models\Grade;
use App\Models\User;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class GradeResource extends Resource
{
    protected static ?string $model = Grade::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                // Forms\Components\TextInput::make('subject.name')
                //     ->label('Subject')
                //     ->required()
                //     ->numeric(),
                // Forms\Components\TextInput::make('teacher.name')
                //     ->label('Teacher')
                //     ->required()
                //     ->numeric(),
                // Forms\Components\TextInput::make('gradeComponent.name')
                //     ->label('Grade Component')
                //     ->required()
                //     ->numeric(),
                // Forms\Components\TextInput::make('score')
                //     ->required()
                //     ->numeric(),
                // Forms\Components\Textarea::make('remarks')
                //     ->columnSpanFull(),
                // Forms\Components\TextInput::make('grading_period')
                //     ->maxLength(255),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('subject.name')
                    ->label('Subject')
                    ->sortable(),
                Tables\Columns\TextColumn::make('teacher.name')
                    ->label('Teacher')
                    ->sortable(),
                Tables\Columns\TextColumn::make('gradeComponent.name')
                    ->label('Grade Component')
                    ->sortable(),
                Tables\Columns\TextColumn::make('score')
                    ->label('Total Score')
                    ->numeric(2)
                    ->sortable(),
            ])
            ->filters([])
            ->actions([
                Tables\Actions\ViewAction::make(),
            ])
            ->bulkActions([]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ManageGrades::route('/'),
        ];
    }
}
