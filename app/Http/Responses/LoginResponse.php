<?php

namespace App\Http\Responses;

use Filament\Facades\Filament;
use Filament\Http\Responses\Auth\Contracts\LoginResponse as LoginResponseContract;

class LoginResponse implements LoginResponseContract
{

    /**
     * Create an HTTP response that represents the object.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function toResponse($request)
    {
        $user = auth()->user();

        if ($user->role->name == 'Admin') {
            return redirect()->intended(Filament::getPanel('admin')->getUrl());
        } elseif ($user->role->name == 'Teacher') {
            return redirect()->intended(Filament::getPanel('teacher')->getUrl());
        } elseif ($user->role->name == 'Student') {
            return redirect()->intended(Filament::getPanel('student')->getUrl());
        }

        return redirect()->intended(Filament::getPanel('student')->getUrl());
    }
}
