<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class SessionController extends Controller
{
    public function create()
    {
        return view('auth.login');
    }

    public function store(Request $request)
    {
        //validation
        $attributes = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);
        //attempt to login
        if (!Auth::attempt($attributes)) {
            throw ValidationException::withMessages(
                [
                    'email' => 'Sorry, those credentials do not match',
                ]
            );
        }
        //regenerate session token
        $request->session()->regenerateToken();
        //redirect
        return redirect('/');
    }

    public function destroy()
    {
        Auth::logout();
        return redirect('/home');
    }
}
