<?php

namespace App\Filament\Resources;

use App\Filament\Resources\EventResource\Pages;
use App\Filament\Resources\EventResource\RelationManagers;
use App\Models\Batch;
use App\Models\Event;
use App\Models\Section as ModelsSection;
use Filament\Forms;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Group;
use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\MarkdownEditor;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Split;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\TimePicker;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Form;
use Filament\Forms\Get;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Filters\Filter;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Filters\TernaryFilter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Facades\Auth;

class EventResource extends Resource
{
    protected static ?string $model = Event::class;

    protected static ?string $navigationIcon = 'heroicon-o-calendar';

    protected static ?string $navigationGroup = 'Resources';

    protected static ?int $navigationSort = 2;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Split::make([
                    Group::make()
                        ->schema([
                            Section::make([
                                Split::make([
                                    TextInput::make('title')
                                        ->required()
                                        ->maxLength(255),
                                    Group::make([
                                        Toggle::make('is_announcement')
                                            ->label('Announcement')
                                            ->required()
                                            ->live(),
                                        Toggle::make('is_public')
                                            ->label('Public')
                                            ->required()
                                            ->live()
                                            ->visible(Auth::user()->role->name == "Admin")
                                    ])
                                ]),
                                MarkdownEditor::make('description')
                                    ->columnSpanFull(),

                            ]),
                            Section::make("Send to")
                                ->schema([
                                    Select::make('batches')
                                        ->relationship('batches', 'name')
                                        ->multiple()
                                        ->native(false)
                                        ->preload()
                                        ->live(),
                                    Select::make('sections')
                                        ->relationship('sections', 'name')
                                        ->multiple()
                                        ->native(false)
                                        ->preload()
                                        ->options(function (Get $get) {
                                            $batchIds = $get('batches');
                                            if (!$batchIds) {
                                                return [];
                                            }
                                            $batches = Batch::where('id', $batchIds)->get();
                                            return ModelsSection::whereBelongsTo($batches)->pluck('name', 'id');
                                        })

                                ])
                                ->visible(fn(Get $get) => $get('is_public') != true)
                        ])
                        ->columns(2)
                        ->columnSpan(2),
                    Section::make([
                        TextInput::make('location')
                            ->maxLength(255)
                            ->columnSpanFull(),
                        DatePicker::make('start_date')
                            ->format('Y-m-d')
                            ->minDate(now())
                            ->required(),
                        DatePicker::make('end_date')
                            ->format('Y-m-d')
                            ->minDate(now()->addDay())
                            ->required(),
                        TimePicker::make('start_time')
                            ->format('H:i:s')
                            ->minDate(now())
                            ->required(),
                        TimePicker::make('end_time')
                            ->format('H:i:s')
                            ->minDate(now()->addMinutes(5))
                            ->required(),
                    ])
                        ->grow(false)
                        ->columns(2)
                        ->visible(fn(Get $get) => $get('is_announcement') != true),
                ])
                    ->columns(2)
                    ->columnSpanFull(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('title')
                    ->searchable(),
                Tables\Columns\IconColumn::make('is_public')
                    ->label('Visibility')
                    ->boolean(),
                Tables\Columns\IconColumn::make('is_announcement')
                    ->boolean(),
                Tables\Columns\TextColumn::make('location')
                    ->searchable(),
                Tables\Columns\TextColumn::make('start_time')
                    ->dateTime('H:i')
                    ->sortable(),
                Tables\Columns\TextColumn::make('start_date')
                    ->dateTime('d/m/y')
                    ->sortable(),
                Tables\Columns\TextColumn::make('end_time')
                    ->dateTime('H:i')
                    ->sortable(),
                Tables\Columns\TextColumn::make('end_date')
                    ->dateTime('d/m/y')
                    ->sortable(),
            ])
            ->filters([
                TernaryFilter::make('is_public')
                    ->label('Visibility'),
                Filter::make('is_announcement')
                    ->label('Announcement')
                    ->query(fn(Builder $query): Builder => $query->where('is_announcement', true))

            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ])
                    ->label(''),
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
            'index' => Pages\ListEvents::route('/'),
            'create' => Pages\CreateEvent::route('/create'),
            'view' => Pages\ViewEvent::route('/{record}/view'),
        ];
    }
}
