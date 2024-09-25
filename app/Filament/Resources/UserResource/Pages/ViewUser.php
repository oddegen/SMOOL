<?php

namespace App\Filament\Resources\UserResource\Pages;

use App\Filament\Resources\UserResource;
use Filament\Actions;
use Filament\Infolists\Components\Grid;
use Filament\Infolists\Components\Group;
use Filament\Infolists\Components\IconEntry;
use Filament\Infolists\Components\ImageEntry;
use Filament\Infolists\Components\Section;
use Filament\Infolists\Components\TextEntry;
use Filament\Infolists\Infolist;
use Filament\Resources\Pages\ViewRecord;
use Illuminate\Support\HtmlString;

class ViewUser extends ViewRecord
{
    protected static string $resource = UserResource::class;

    public function infolist(Infolist $infolist): Infolist
    {
        return $infolist
            ->schema([
                Group::make()
                    ->schema([
                        ImageEntry::make('avatar_url')
                            ->label('Profile Photo')
                            ->defaultImageUrl(url('https://placehold.co/200')),
                        Group::make([
                            TextEntry::make('first_name')
                                ->label('First Name'),
                            TextEntry::make('last_name')
                                ->label('Last Name'),
                        ]),
                        TextEntry::make('original_email')
                            ->label('Original Email')
                            ->helperText(new HtmlString('<p class="text-xs">Email used to create the account.</p>'))
                            ->icon('heroicon-o-exclamation-circle')
                            ->iconColor('warning'),
                        TextEntry::make('email')
                            ->label('Email'),
                        TextEntry::make('role.name')
                            ->label('Role')
                            ->icon(function ($state) {
                                if ($state === 'Teacher') {
                                    return 'heroicon-o-academic-cap';
                                }

                                if ($state === 'Student') {
                                    return 'heroicon-o-user-group';
                                }

                                return 'heroicon-o-shield-check';
                            }),
                        TextEntry::make('phone')
                            ->label('Phone Number'),
                        TextEntry::make('gender'),
                        IconEntry::make('is_profile_complete')
                            ->label('Is Active')
                            ->icon(function ($state) {
                                return $state ? 'heroicon-o-check-circle' : 'heroicon-o-x-circle';
                            })
                            ->color(function ($state) {
                                return $state ? 'success' : 'danger';
                            }),
                        TextEntry::make('address')
                            ->label('Address')
                            ->columnSpanFull(),
                        TextEntry::make('bio')
                            ->label('Bio')
                            ->columnSpanFull(),
                        Section::make()
                            ->heading('Subjects')
                            ->schema([
                                Grid::make()
                                    ->schema([
                                        TextEntry::make('subjects.*.name')
                                            ->label('Name'),
                                        TextEntry::make('subjects.*.code')
                                            ->label('Code'),
                                    ])
                                    ->columns()
                                    ->columnSpanFull(),
                            ])
                            ->visible(fn($record) => $record->role->name === 'Teacher'),
                        // Section::make()
                        //     ->heading('Class')
                        //     ->schema([
                        //         Grid::make()
                        //             ->schema([
                        //                 TextEntry::make('batches.*.name')
                        //                     ->label('Batch'),
                        //                 TextEntry::make('sections.*.name')
                        //                     ->label('Section'),
                        //             ])
                        //             ->columns()
                        //             ->columnSpanFull()
                        //     ])
                        //     ->visible(fn($record) => $record->role->name === 'Student'),
                    ])
                    ->columns()
                    ->columnSpanFull()
            ]);
    }
}
