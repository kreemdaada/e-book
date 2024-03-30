<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Book; // Stelle sicher, dass das Book-Modell importiert wird

class HomeController extends Controller
{
    public function index()
    {
        // Hier rufe die Bücher ab und übergebe sie an die View
        $books = Book::all(); // Beispiel: Alle Bücher aus der Datenbank abrufen

        $navbar = view('includes.navbar');

        // Die Navbar und die Bücher werden als Variablen an die Home-Seite übergeben
        return view('home.index', compact('navbar', 'books'));
    }
}
