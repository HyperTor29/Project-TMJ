<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Models\User;

class VerifyApiToken
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Ambil token dari header Authorization
        $token = $request->header('Authorization');

        // Cek apakah token tersedia dan valid
        if (!$token || !$user = User::where('api_token', $token)->first()) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        // Set user ke context autentikasi
        \Illuminate\Support\Facades\Auth::setUser($user);

        return $next($request);
    }
}
