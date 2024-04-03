<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Book;

class UserController extends Controller
{
    public function profile()
    {
        // Benutzer abrufen
        $user = auth()->user();

        // Alle heruntergeladenen Bücher des Benutzers abrufen
        $downloadedBooks = Book::where('downloaded', 1)->where('author_id', $user->id)->get();

        // Anzahl der heruntergeladenen Bücher
        $downloadedBooksCount = $downloadedBooks->count();

        // Übergeb die Benutzerdaten und die heruntergeladenen Bücher an die Profilansicht
        return view('user.profile', compact('user', 'downloadedBooks', 'downloadedBooksCount'));
    }
}
