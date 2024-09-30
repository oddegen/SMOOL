<?php

namespace App\Filament\Pages\Auth;

use Filament\Pages\Auth\Login as BasePage;

class TeacherLogin extends BasePage
{
    public function mount(): void
    {
        parent::mount();

        $this->form->fill([
            'email' => 'teacher2@school.com',
            'password' => 'password',
            'remember' => true,
        ]);
    }
}
