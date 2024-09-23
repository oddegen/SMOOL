<?php

namespace App\Filament\Resources;

use App\Filament\Resources\BatchResource\Pages;
use App\Filament\Resources\BatchResource\RelationManagers;
use App\Models\Batch;
use Filament\Forms;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Section;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\HtmlString;

class BatchResource extends Resource
{
    protected static ?string $label = "Classes";

    protected static ?string $slug = "classes";

    protected static ?string $model = Batch::class;

    protected static ?string $navigationIcon = 'heroicon-o-user-group';

    protected static ?string $navigationGroup = 'Resources';

    protected static ?int $navigationSort = 1;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                    ->required()
                    ->maxLength(255),
                Section::make()
                    ->schema([
                        Repeater::make('Sections')
                            ->schema([
                                Forms\Components\TextInput::make('name')
                                    ->unique()
                                    ->required()
                                    ->maxLength(255),
                                Section::make('Students')
                                    ->schema([
                                        Repeater::make('students')
                                            ->schema([
                                                Forms\Components\TextInput::make('name')
                                                    ->required()
                                                    ->maxLength(255),
                                                Forms\Components\TextInput::make('roll_no')
                                                    ->required()
                                                    ->numeric(),
                                            ])
                                            ->label(fn($state) => empty($state) ? new HtmlString('<div style="text-align: center; font-weight: bold; color: red;"><i>No students</i></div>') : '')
                                            ->addActionLabel('Add Student')
                                            ->columns()
                                            ->cloneable()
                                    ])
                                    ->collapsible()
                            ])
                            ->columns()
                            ->cloneable()
                            ->relationship('sections')
                    ])
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
            'index' => Pages\ListBatches::route('/'),
            'edit' => Pages\EditBatch::route('/{record}/edit'),
        ];
    }
}
