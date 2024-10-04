<?php

namespace App\Livewire;

use App\Models\User;
use Filament\Forms\Components\Group;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Form;
use Filament\Notifications\Notification;
use Filament\Support\Exceptions\Halt;
use Livewire\Component;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\HtmlString;
use Joaopaulolndev\FilamentEditProfile\Concerns\HasSort;
use Joaopaulolndev\FilamentEditProfile\Concerns\HasUser;

class CustomProfileComponent extends Component implements HasForms
{
    use InteractsWithForms, HasUser;
    use HasSort;

    public ?array $data = [];

    protected static int $sort = 0;

    public function mount(): void
    {
        $this->user = $this->getUser();
        $this->form->fill($this->user->toArray());
    }

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Group::make()
                    ->schema([
                        Group::make([
                            TextInput::make('first_name')
                                ->label('First Name'),
                            TextInput::make('last_name')
                                ->label('Last Name'),
                        ])
                            ->columns()
                            ->columnSpanFull(),
                        Group::make([
                            TextInput::make('original_email')
                                ->label('Original Email')
                                ->helperText(new HtmlString('<p class="text-xs">Email used to create the account.</p>'))
                                ->hintIcon('heroicon-o-exclamation-circle')
                                ->hintColor('warning'),
                            TextInput::make('email')
                                ->readOnly()
                                ->dehydrated(false)
                                ->label('Email'),
                        ])
                            ->columns()
                            ->columnSpanFull(),
                        TextInput::make('phone')
                            ->label('Phone Number'),
                        Select::make('gender')
                            ->options([
                                'male' => 'Male',
                                'female' => 'Female',
                            ]),
                        TextInput::make('address')
                            ->label('Address')
                            ->columnSpanFull(),
                        TextInput::make('bio')
                            ->label('Bio')
                            ->columnSpanFull(),
                    ])
                    ->columns()
                    ->columnSpanFull()
            ])
            ->statePath('data');
    }

    public function save(): void
    {
        try {
            $data = $this->form->getState();

            $isProfileComplete = !empty($data['first_name']) &&
                !empty($data['last_name']) &&
                !empty($data['phone']) &&
                !empty($data['gender']) &&
                !empty($data['address']);

            $data['is_profile_complete'] = $isProfileComplete;

            $this->user->update($data);
        } catch (Halt $exception) {
            return;
        }

        Notification::make()
            ->success()
            ->title(__('filament-edit-profile::default.saved_successfully'))
            ->send();
    }

    public function render(): View
    {
        return view('livewire.custom-profile-component');
    }
}
