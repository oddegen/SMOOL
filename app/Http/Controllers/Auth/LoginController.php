<?php

namespace App\Http\Controllers\Auth;

use Symfony\Component\HttpFoundation\Response;
use Spatie\WelcomeNotification\WelcomeController;

class LoginController extends WelcomeController
{
    public function sendPasswordSavedResponse(): Response

    {
        return redirect('/');
    }
}
