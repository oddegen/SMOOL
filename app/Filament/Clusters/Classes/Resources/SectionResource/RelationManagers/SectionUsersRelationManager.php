<?php

namespace App\Filament\Clusters\Classes\Resources\SectionResource\RelationManagers;

use App\Models\User;
use App\Models\SectionUser;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class SectionUsersRelationManager extends RelationManager
{
    protected static string $relationship = 'sectionUsers';

    protected static ?string $title = 'Students';

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('student_id')
                    ->label('Student')
                    ->options(function () {
                        $currentYear = now()->year;
                        return User::whereHas('role', function ($query) {
                            $query->where('name', 'Student');
                        })
                            ->whereDoesntHave('sectionUsers', function ($query) use ($currentYear) {
                                $query->where('year', $currentYear);
                            })
                            ->pluck('name', 'id');
                    })
                    ->searchable()
                    ->required(),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('student.name')
            ->columns([
                Tables\Columns\TextColumn::make('student.name')
                    ->label('Student Name')
                    ->searchable(),
                Tables\Columns\TextColumn::make('year')
                    ->label('Year'),
            ])
            ->filters([
                //
            ])
            ->headerActions([
                Tables\Actions\CreateAction::make('Add Student')
                    ->label('Add Student')
                    ->mutateFormDataUsing(function (array $data): array {
                        $data['year'] = now()->year;
                        $data['teacher_id'] = $this->getOwnerRecord()->teacher_id;
                        return $data;
                    })
                    ->after(function (SectionUser $record) {
                        $this->resetTable();
                    }),
            ])
            ->actions([
                Tables\Actions\DeleteAction::make(),
                Tables\Actions\Action::make('view')
                    ->label('View')
                    ->url(fn(Model $record): string => route('filament.admin.resources.users.view', [
                        'record' => $record->student_id,
                    ])),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
            ]);
    }
}
