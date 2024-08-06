<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\Rules\Password;
use Illuminate\View\View;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class RegisteredUserController extends Controller
{
    public function create(): View
    {
        return view('auth.register');
    }

    public function store(Request $request)
    {
        //validation
        $attributes = $request->validate([
            'name' => ['required', 'max:50'],
            'email' => ['required', 'email', 'max:254'],
            'password' => ['required', 'confirmed', Password::min(6)] // password_confirmation
        ]);
        //create user
        $user = User::create($attributes);
        //login
        Auth::login($user);
        //redirect
        return redirect('/contact');
    }
}
