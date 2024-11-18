<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;

class AuthenticateApi extends Middleware
{
    protected function unauthenticated($request, array $guards)
    {
        return response()->json(['message' => 'User not authenticated'], 401);
    }
}
