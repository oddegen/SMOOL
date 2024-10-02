<?php

namespace App\Filament\Teacher\Resources;

use App\Filament\Teacher\Resources\EnrollmentResource\Pages;
use App\Filament\Teacher\Resources\EnrollmentResource\RelationManagers;
use App\Models\Enrollment;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Facades\Auth;

class EnrollmentResource extends Resource
{
    protected static ?string $model = Enrollment::class;

    protected static ?string $navigationIcon = 'heroicon-o-user-plus';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('student_id')
                    ->relationship('student', 'name', modifyQueryUsing: fn($query) => $query->where('role_id', 3))
                    ->label('Student Name')
                    ->required(),
                Forms\Components\Select::make('section_id')
                    ->relationship('section', 'name')
                    ->label('Section Name')
                    ->required(),
                Forms\Components\Select::make('subject_id')
                    ->relationship('subject', 'name')
                    ->label('Subject Name')
                    ->required(),
                Forms\Components\TextInput::make('school_year')
                    ->required()
                    ->numeric()
                    ->default(date('Y')),
                Forms\Components\ToggleButtons::make('status')
                    ->required()
                    ->options([
                        'pending' => 'Pending',
                        'enrolled' => 'Enrolled',
                        'rejected' => 'Rejected',
                    ])
                    ->icons([
                        'pending' => 'heroicon-o-clock',
                        'enrolled' => 'heroicon-o-check-circle',
                        'rejected' => 'heroicon-o-x-circle',
                    ])
                    ->inline()
                    ->default('pending'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('student.name')
                    ->sortable(),
                Tables\Columns\TextColumn::make('section.name')
                    ->sortable(),
                Tables\Columns\TextColumn::make('subject.name')
                    ->sortable(),
                Tables\Columns\TextColumn::make('school_year')
                    ->sortable(),
                Tables\Columns\IconColumn::make('status')
                    ->icon(fn($state) => match ($state) {
                        'pending' => 'heroicon-o-clock',
                        'enrolled' => 'heroicon-o-check-circle',
                        'rejected' => 'heroicon-o-x-circle',
                    })
                    ->searchable(),
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
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
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
            'index' => Pages\ListEnrollments::route('/'),
            'create' => Pages\CreateEnrollment::route('/create'),
            'edit' => Pages\EditEnrollment::route('/{record}/edit'),
        ];
    }

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()
            ->whereHas('section', function ($query) {
                $query->whereHas('sectionUsers', function ($query) {
                    $query->where('teacher_id', Auth::id());
                });
            });
    }
}
