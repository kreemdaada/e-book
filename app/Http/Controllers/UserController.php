<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User; // das User-Modell importiert ist

class UserController extends Controller
{
    public function profile()
    {
        // ob der Benutzer authentifiziert ist
        if (!auth()->check()) {
            // Wenn nicht, leiten Sie ihn zur Login-Seite weiter
            return redirect()->route('login')->with('error', 'Sie müssen angemeldet sein, um Ihr Profil anzuzeigen.');
        }

        $user = auth()->user();
        $downloadedBooks = [];

        if ($user->is_author) {
            // Der Benutzer ist ein Autor, holen Sie seine heruntergeladenen Bücher
            $downloadedBooks = $user->books()->where('downloaded', true)->get();
        }

        // Übergeben Sie die Benutzerdaten und die heruntergeladenen Bücher an die Profilansicht
        return view('user.profile', compact('user', 'downloadedBooks'));
    }
}
