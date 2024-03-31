<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Book; // Stelle sicher, dass das Book-Modell importiert wird

class HomeController extends Controller
{
    public function index()
    {
        // Hier rufe die Bücher ab und übergebe die an die View
        $books = Book::with('author')->get();

        // Geben Sie die Daten an die View weiter
        return view('home.index', ['books' => $books]);
#-----------------------------------------------------------
        $navbar = view('includes.navbar');

        // Die Navbar und die Bücher werden als Variablen an die Home-Seite übergeben
        return view('home.index', compact('navbar', 'books'));
    }
}

//kareem 11:08 31.03
//ich bekomme keine neue bücher in databank oder in home view