<?php

namespace App\Filament\Teacher\Widgets;

use App\Models\User;
use Filament\Widgets\Widget;
use Illuminate\Support\Facades\Auth;

class TeacherInfoCard extends Widget
{
    protected static string $view = 'filament.teacher.widgets.teacher-info-card';

    public function getUser()
    {
        return User::find(auth()->user()->id);
    }

    protected int | string | array $columnSpan = 'full';
}
