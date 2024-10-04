<?php

namespace App\Filament\Pages;

use App\Settings\SchoolSettings;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Pages\SettingsPage;

class ManageSchool extends SettingsPage
{
    protected static ?string $navigationIcon = 'heroicon-o-cog-6-tooth';

    protected static string $settings = SchoolSettings::class;

    protected static ?int $navigationSort = 3;

    protected static ?string $title = 'School Settings';

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                    ->label('School Name'),
                Forms\Components\TextInput::make('email')
                    ->label('School Email')
                    ->email(),
                Forms\Components\TextInput::make('phone')
                    ->label('School Phone')
                    ->tel(),
                Forms\Components\TextInput::make('address')
                    ->label('School Address'),
                Forms\Components\Textarea::make('info')
                    ->label('School Info')
                    ->columnSpanFull(),
                Forms\Components\FileUpload::make('logo')
                    ->label('School Logo')
                    ->image(),
                Forms\Components\FileUpload::make('favicon')
                    ->label('School Favicon')
                    ->image(),
                Forms\Components\ToggleButtons::make('theme')
                    ->label('School Theme')
                    ->icons([
                        'light' => 'heroicon-o-sun',
                        'dark' => 'heroicon-o-moon',
                    ])
                    ->options([
                        'light' => 'Light Theme',
                        'dark' => 'Dark Theme',
                    ])
                    ->default('light')
                    ->inline(),
                Forms\Components\TextInput::make('domain')
                    ->label('Domain'),
                Forms\Components\TextInput::make('batch_prefix')
                    ->label('Batch Prefix'),
                Forms\Components\TextInput::make('section_prefix')
                    ->label('Section Prefix'),
                Forms\Components\TextInput::make('batch_start')
                    ->label('Batch Start')
                    ->numeric(),
                Forms\Components\TextInput::make('batch_end')
                    ->label('Batch End')
                    ->numeric(),
                Forms\Components\Select::make('section_suffix_type')
                    ->label('Section Suffix Type')
                    ->options([
                        'alphabets' => 'Alphabets',
                        'numbers' => 'Numbers',
                        'romans' => 'Romans',
                    ]),
            ]);
    }

    public static function getNavigationGroup(): ?string
    {
        return __('Settings');
    }

    public static function getNavigationLabel(): string
    {
        return __('School');
    }
}
