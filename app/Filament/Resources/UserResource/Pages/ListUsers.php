<?php

namespace App\Filament\Resources\UserResource\Pages;

use App\Filament\Exports\UserExporter;
use App\Filament\Imports\UserImporter;
use App\Filament\Resources\UserResource;
use App\Mail\UserCreated;
use App\Models\Role;
use App\Models\User;
use App\Settings\SchoolSettings;
use Filament\Actions\CreateAction;
use Filament\Forms\Components\Actions\Action;
use Filament\Forms\Components\Group;
use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\ToggleButtons;
use Filament\Forms\Get;
use Filament\Forms\Set;
use Filament\Resources\Pages\ListRecords;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

use Filament\Actions;
use Filament\Actions\ExportAction;
use Filament\Actions\ImportAction;

class ListUsers extends ListRecords
{
    protected static string $resource = UserResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make('New User')
                ->model(User::class)
                ->form([
                    Group::make([
                        TextInput::make('name')
                            ->label('Username')
                            ->maxLength(255)
                            ->required(),
                        TextInput::make('original_email')
                            ->label('Email')
                            ->email()
                            ->required(),
                        TextInput::make('email')
                            ->label('Generated Email')
                            ->email()
                            ->required()
                            ->string()
                            ->readOnly()
                            ->suffixAction(
                                Action::make('generate_email')
                                    ->icon('heroicon-o-inbox')
                                    ->action(function (Set $set, Get $get) {
                                        if ($get('original_email') != null) {
                                            $name = explode('@', $get('original_email'))[0];
                                            $randomString = Str::random(8);
                                            $domain = '@' . app(SchoolSettings::class)->domain . '.com';
                                            $set('email', $name . $randomString . $domain);
                                        }
                                    })
                            ),
                        Select::make('role')
                            ->label('Role')
                            ->relationship('role', 'name')
                            ->required()
                            ->live()
                            ->native(false)
                            ->preload(),
                        Group::make()
                            ->schema([
                                Group::make()
                                    ->schema([
                                        Select::make('subject')
                                            ->relationship('subjects', 'name')
                                            ->required()
                                            ->native(false)
                                            ->multiple()
                                            ->preload(),
                                    ])
                                    ->visible(fn(Get $get) => $get('role') == Role::where('name', 'Teacher')->first()->id),
                                Group::make()
                                    ->schema([
                                        Select::make('batch')
                                            ->label('Class')
                                            ->relationship('batches', 'name')
                                            ->required(),
                                        ToggleButtons::make('status')
                                            ->label('Status')
                                            ->options([
                                                'passed' => 'Pass',
                                                'fail' => 'Fail'
                                            ])
                                            ->icons([
                                                'passed' => 'heroicon-o-check-circle',
                                                'fail' => 'heroicon-o-x-circle'
                                            ])
                                            ->colors([
                                                'passed' => 'success',
                                                'fail' => 'danger'
                                            ])
                                            ->required()
                                            ->inline(),
                                    ])
                                    ->columns()
                                    ->columnSpanFull()
                                    ->visible(fn(Get $get) => $get('role') == Role::where('name', 'Student')->first()->id),
                            ])
                            ->columns()
                            ->columnSpanFull(),

                    ])
                        ->columns(2)
                        ->columnSpanFull()
                ])
                ->mutateFormDataUsing(
                    function (array $data) {
                        $data['password'] = Str::random(16);
                        return $data;
                    }
                )
                ->after(
                    function (array $data) {
                        $token = Str::random(32);

                        DB::table('access_tokens')->insert([
                            'token' => hash('sha256', $token),
                            'expires_at' => Carbon::now()->addDays(3),
                            'email' => $data['email'],
                            'password' => bcrypt($data['password']),
                        ]);

                        $expiresAt = now()->addDay();

                        User::where('original_email', $data['original_email'])->first()->sendWelcomeNotification($expiresAt);
                    }
                )
                ->successNotificationTitle("User created")
                ->createAnother(false)
                ->successRedirectUrl(fn(Model $record) => route('filament.admin.resources.users.view', [
                    'record' => $record,
                ])),
            ImportAction::make('Import Users')
                ->importer(UserImporter::class),
            ExportAction::make('Export Users')
                ->exporter(UserExporter::class)
        ];
    }
}
