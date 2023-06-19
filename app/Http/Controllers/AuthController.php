<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    // Send login form
    public function create()
    {
        // If authenticated, redirect to /user
        if (auth()->check()) {
            return redirect('/user');
        }

        return view('login');
    }

    // $request->has('remember') zamiast true

    // Authenticate the session
    public function store(Request $request)
    {
        if (!Auth::attempt($request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string'
        ]),true)) {
            throw ValidationException::withMessages([
                'email' => 'Invalid credentials'
            ]);
        }

        $request->session()->regenerate();

        return redirect()->intended('/user');
    }

    // Destroy session (logout)
    public function destroy(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate(); // sprawia ze token nie jest valid

        $request->session()->regenerateToken(); //ustawia nowy CSRF token

        return redirect('/');
    }


}
