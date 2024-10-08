<?php

namespace App\Filament\Clusters\Classes\Resources;

use App\Filament\Clusters\Classes;
use App\Filament\Clusters\Classes\Resources\SectionResource\Pages;
use App\Filament\Clusters\Classes\Resources\SectionResource\RelationManagers;
use App\Filament\Widgets\CalendarWidget;
use App\Filament\Widgets\SectionScheduleCalendar;
use App\Models\Schedule;
use App\Models\Section;
use App\Models\User;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Grouping\Group;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class SectionResource extends Resource
{
    protected static ?string $model = Section::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static ?string $cluster = Classes::class;

    protected static bool $shouldRegisterNavigation = false;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                    ->required()
                    ->maxLength(255),
                Forms\Components\Select::make('teacher_id')
                    ->options(User::where('role_id', 2)->pluck('name', 'id'))
                    ->label('Teacher')
                    ->preload()
                    ->required()
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->searchable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('batches.name')
                    ->badge()
                    ->toggleable()
                    ->searchable()
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
            ])
            ->modifyQueryUsing(
                fn(Builder $query) => $query->with('batches')
            );
        // ->defaultGroup('batches.name');
    }

    public static function getRelations(): array
    {
        return [
            RelationManagers\SectionUsersRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListSections::route('/'),
            'create' => Pages\CreateSection::route('/create'),
            'edit' => Pages\EditSection::route('/{record}/edit'),
            'schedule' => Pages\Calender::route('/{record}/schedule')
        ];
    }

    public static function getWidgets(): array
    {
        return [
            SectionResource\Widgets\CalendarWidget::class,
        ];
    }
}
