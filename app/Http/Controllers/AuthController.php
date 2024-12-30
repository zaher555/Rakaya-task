<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function login(LoginRequest $validatedData)
    {
        $credentials=$validatedData->validated();
        if (Auth::attempt($credentials)) {
            $validatedData->session()->regenerate();
            return redirect()->intended('/books');
        }
 
        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ])->onlyInput('email');
    }
    public function logout()
    {
        return 'logout';
    }
}
