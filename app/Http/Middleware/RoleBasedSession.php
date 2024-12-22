<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class RoleBasedSession
{
    public function handle($request, Closure $next)
    {
        if (Auth::check()) {
            $user = Auth::user();
            $roleName = $user->role->name;

            // Set session based on role
            session(['role' => $roleName]);
        }

        return $next($request);
    }
}
