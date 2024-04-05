<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AuthUserController extends Controller
{

    public function loginPage(){

        return view('auth.login');
    }

    public function login(Request $request){

        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (auth()->attempt($credentials)) {

            $request->session()->regenerate();

            return redirect()->intended('/');

        }

        return redirect()->back()->withErrors(['email' => 'The provided credentials do not match our records.']);
    }

    public function logout(Request $request){

        auth()->logout();

        $request->session()->invalidate();

        return redirect()->route('login-page');
    }
}
