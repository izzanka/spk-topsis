<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{

    // public function register_index()
    // {
    //     return view('auth.register');
    // }

    // public function register_store(Request $request)
    // {
    //     $request->validate([
    //         'username' => ['required','string','max:25','unique:users,username'],
    //         'password' => ['required','max:25'],
    //     ]);

    //     try {

    //         $user = User::create([
    //             'username' => $request->username,
    //             'password' => bcrypt($request->password),
    //         ]);

    //         Auth::login($user);

    //         return redirect()->route('home');

    //     } catch (\Throwable $th) {
    //         return back()->with('message',['text' => 'Register gagal.', 'class' => 'danger']);
    //     }
    // }

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

        try {

            if(Auth::attempt($credentials)){
                $request->session()->regenerate();

                return redirect()->route('home');
            }

            return back()->with('message',['text' => 'Username atau password salah.', 'class' => 'danger']);

        } catch (\Throwable $th) {
            return back()->with('message',['text' => 'Login gagal.', 'class' => 'danger']);
        }
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect()->route('home');
    }
}
