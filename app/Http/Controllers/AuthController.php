<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function showRegistrationForm()
    {
        return view('auth.register');
    }

    public function register(Request $request)
    {
        #----------------------------------------
        //debugger Ausgabe des Anforderungs-Arrays
       #dd($request->all());
       #--------------------------------------
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
            
        ]);

        $user = \App\Models\User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'is_author' => $request->is_author,
        ]);

        if ($request->has('is_author')) {
            $author = new \App\Models\Author();
            $author->name = $user->name;
            $author->user_id = $user->id;
            $author->save();
        }

        auth()->login($user);

        return redirect('/home');
    }

    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string',
        ]);

        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            return redirect()->intended('/home');
        } else {
            return back()->withErrors(['email' => 'Invalid credentials']);
        }
    }
    
    public function logout()
    {
        Auth::logout();
        return redirect('/login');
    }
}
