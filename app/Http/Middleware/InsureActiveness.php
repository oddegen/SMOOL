<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class InsureActiveness
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (Auth::check()) {
            $user = Auth::user();
            $role = strtolower($user->role->name) ?? 'student';
            $profileRoute = "filament.{$role}.pages.my-profile";

            if ($request->route()->getName() !== $profileRoute) {
                if (!$user->is_profile_complete) {
                    return redirect()->route($profileRoute)
                        ->with('warning', 'Please complete your profile.');
                }
            }
        }

        return $next($request);
    }
}
