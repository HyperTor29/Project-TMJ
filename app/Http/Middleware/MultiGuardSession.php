<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class MultiGuardSession
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle($request, Closure $next, $guard)
    {
        // Modifikasi nama cookie sesi berdasarkan guard
        config(['session.cookie' => config('session.cookie') . '_' . $guard]);

        return $next($request);
    }
}
