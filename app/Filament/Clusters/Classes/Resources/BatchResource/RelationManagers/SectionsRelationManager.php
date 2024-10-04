<?php

namespace App\Filament\Clusters\Classes\Resources\BatchResource\RelationManagers;

use App\Models\Section;
use App\Settings\SchoolSettings;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Actions\Action;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class SectionsRelationManager extends RelationManager
{
    protected static string $relationship = 'sections';

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('name')
                    ->prefix(app(SchoolSettings::class)->section_prefix)
                    ->required()
                    ->maxLength(255),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('name')
            ->columns([
                Tables\Columns\TextColumn::make('name'),
            ])
            ->filters([
                //
            ])
            ->headerActions([
                Tables\Actions\CreateAction::make()
                    ->mutateFormDataUsing(function (array $data): array {
                        $data['name'] = app(SchoolSettings::class)->section_prefix . ' ' . $data['name'];

                        return $data;
                    }),
            ])
            ->actions([
                Tables\Actions\DeleteAction::make(),
                Action::make('view')
                    ->url(fn(Section $record) => route('filament.admin.classes.resources.sections.edit', $record))
                    ->label('View')
                    ->icon('heroicon-m-eye'),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
            ])
            ->modifyQueryUsing(function (Builder $query) {
                $query->where('year', now()->year);
            });
    }
}
