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
        // Validierung der Registrierungsdaten
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
        ]);

        // Erstellen eines neuen Benutzers
        $user = \App\Models\User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
        ]);

        // Anmelden des Benutzers nach der Registrierung
        Auth::login($user);

        // Umleitung nach der erfolgreichen Registrierung
        return redirect('/home');
    }

    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        // Validierung der Anmeldedaten
        $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string',
        ]);

        // Überprüfung der Anmeldeinformationen
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            // Wenn die Anmeldeinformationen gültig sind, wird der Benutzer angemeldet und umgeleitet
            return redirect()->intended('/home');
        } else {
            // Wenn die Anmeldeinformationen ungültig sind, wird der Benutzer zurück zum Anmeldeformular geleitet
            return back()->withErrors(['email' => 'Invalid credentials']);
        
        }
    }
    
    public function logout()
    {
        Auth::logout();
        return redirect('/login');
    }
}
