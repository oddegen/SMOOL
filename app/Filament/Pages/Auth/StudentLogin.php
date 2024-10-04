<?php

namespace App\Filament\Pages\Auth;

use Filament\Pages\Auth\Login as BasePage;

class StudentLogin extends BasePage
{
    public function mount(): void
    {
        parent::mount();

        $this->form->fill([
            'email' => 'SelamkKK44Bto@digitalSchool.com',
            'password' => 'password',
            'remember' => true,
        ]);
    }
}
