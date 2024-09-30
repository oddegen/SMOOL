<?php

namespace App\Http\Middleware;

use Closure;
use Filament\Facades\Filament;
use Filament\Http\Middleware\Authenticate;
use Filament\Models\Contracts\FilamentUser;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RedirectBasedOnRole extends Authenticate
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    protected function authenticate($request, array $guards): void
    {
        $guard = Filament::auth();

        if (! $guard->check()) {
            $this->unauthenticated($request, $guards);

            return;
        }

        $this->auth->shouldUse(Filament::getAuthGuard());

        /** @var Model $user */
        $user = $guard->user();

        $panel = Filament::getCurrentPanel();

        // abort_if(
        //     $user instanceof FilamentUser ?
        //         (! $user->canAccessPanel($panel)) : (config('app.env') !== 'local'),
        //     403,
        // );

        if ($user instanceof FilamentUser && ! $user->canAccessPanel($panel)) {
            $this->redirect($request, $guards);

            return;
        }
    }

    protected function redirect(Request $request, array $guards)
    {
        throw new AuthenticationException(
            'Unauthorized.',
            $guards,
            $request->session()->previousUrl(),
        );
    }
}
