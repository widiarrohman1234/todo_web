<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function loginView()
    {
        return view('login');
    }

    public function login(Request $request)
    {
        if (Auth::attempt(['email' => request('email'), 'password' => request('password')])) {
            return redirect('todos/index');
        } else {
            return redirect('/')->withErrors('');
        }
    }

    public function registerView()
    {
        return view('register');
    }


    public function register(Request $request)
    {
        $user = User::create([
            'username' => $request->username,
            'email' => $request->email,
            'password' => bcrypt(request('password')),
        ]);
        return view('login');
    }

    public function logout()
    {
        Auth::logout();
        return redirect('/');
    }
}
