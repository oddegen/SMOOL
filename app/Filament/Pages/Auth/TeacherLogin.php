<?php

namespace App\Filament\Pages\Auth;

use Filament\Pages\Auth\Login as BasePage;

class TeacherLogin extends BasePage
{
    public function mount(): void
    {
        parent::mount();

        $this->form->fill([
            'email' => 'samuksdoTOE@digitalSchool.com',
            'password' => 'password',
            'remember' => true,
        ]);
    }
}
