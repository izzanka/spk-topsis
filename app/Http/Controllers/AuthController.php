<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function login_index()
    {
        return view('auth.login');
    }

    public function login_store(Request $request)
    {
        $credentials = $request->validate([
            'username' => ['required','string','max:25'],
            'password' => ['required'],
        ]);

        if(Auth::attempt($credentials)){
            $request->session()->regenerate();

            return view('home');
        }

        return back()->with('message',['text' => 'Username atau password salah.', 'class' => 'danger']);
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return view('home');
    }
}
