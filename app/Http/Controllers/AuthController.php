<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    /* public function register(Request $request)
    {
        $request->validate([
            'email'             => 'required|unique:users,email',
            'password'          => 'required|string|min:4',
            'confirm_password'  => 'required'
        ]);

        if ($request['password'] != $request['confirm_password']) {
            return redirect('/login')->withErrors(['error' => 'corfirm password and password does not match']);
        }

        $user = new User();
        $user->email = $request['email'];
        $user->password = Hash::make($request['password']);

        $user->save();

        return redirect('/tasks');
    } */

    public function login(Request $request)
    {
        $request->validate([
            'email'    => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::attempt([
            'email'    => $request['email'],
            'password' => $request['password']
        ])) {
            $request->session()->regenerate();

            return redirect()->intended('/dashboard');
        }

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ]);
    }
}
