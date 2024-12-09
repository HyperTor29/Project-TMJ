<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Filament\Facades\Filament;

class LoginController extends Controller
{
    public function showLoginForm()
    {
        return view('filament.auth.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->only('login', 'password');

        if (Filament::auth()->attempt(['name' => $credentials['login'], 'password' => $credentials['password']], $request->filled('remember'))) {
            session()->regenerate();

            $user = Filament::auth()->user();

            return $this->redirectBasedOnRole($user);
        }

        return back()->withErrors([
            'login' => 'The provided credentials do not match our records.',
        ])->withInput($request->only('login'));
    }

    private function redirectBasedOnRole($user)
    {
        $roleName = $user->role->name;

        switch ($roleName) {
            case 'Admin':
                return redirect('/admin');
            case 'User':
                return redirect('/user');
            case 'Verificator':
                return redirect('/verificator');
            case 'Validator':
                return redirect('/validator');
            case 'Viewer':
                return redirect('/viewer');
            default:
                return redirect()->intended(Filament::getUrl());
        }
    }

    public function logout(Request $request)
    {
        Filament::auth()->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login');
    }
}


