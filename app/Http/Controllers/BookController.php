<?php

namespace App\Http\Controllers;

use App\Models\Author;
use App\Models\Book;
use Illuminate\Http\Request;
use App\Http\Middleware\AuthorMiddleware;

class BookController extends Controller
{
    public function __construct()
    {
        // Führe das AuthorMiddleware für alle Methoden außer 'index' und 'show' aus
        $this->middleware(AuthorMiddleware::class)->except('index', 'show');
    }

    public function index()
    {
        // Lade alle Bücher und deren Autoren
        $books = Book::with('author')->get();
        return view('books.index', compact('books'));
    }

    public function create()
    {
        // Lade alle Autoren für das Formular zum Erstellen eines Buches
        $authors = Author::all(); 
        return view('books.create', compact('authors')); 
    }

    public function store(Request $request)
    {
        // Überprüfe, ob der aktuelle Benutzer ein Autor ist
        if (auth()->user()->author) {
            $authorName = $request->input('author');
    
            // Stelle sicher, dass der Autorname nicht leer ist
            if (!empty($authorName)) {
                // Erstelle den Autor, falls er nicht vorhanden ist
                $author = Author::firstOrCreate(['name' => $authorName]); 
    
                // Erstelle das Buch
                $book = new Book();
                $book->title = $request->input('title');
                $book->author = $request->input('author');
                $book->description = substr($request->input('description'), 0, 255); // Beschreibung auf maximal 255 Zeichen kürzen
                $book->author_id = $author->id;
                $book->save();
    
                return redirect()->route('books.index');
            } else {
                // Zeige eine Fehlermeldung an, wenn der Autorname fehlt
                return redirect()->back()->withErrors('Autorname fehlt.');
            }
        } else {
            // Zeige eine Fehlermeldung an, wenn der Benutzer kein Autor ist
            return redirect()->back()->withErrors('Nur Autoren dürfen Bücher erstellen.');
        }
    }

    public function edit($id)
    {
        // Finde das Buch anhand der ID
        $book = Book::findOrFail($id);

        // Überprüfe, ob der angemeldete Benutzer der Autor des Buches ist
        if ($book->author_id != auth()->user()->id) {
            abort(403, 'Sie haben keine Berechtigung, dieses Buch zu bearbeiten.');
        }

        return view('books.edit', compact('book'));
    }

    public function destroy($id)
    {
        // Finde das Buch anhand der ID
        $book = Book::findOrFail($id);

        // Überprüfe, ob der angemeldete Benutzer der Autor des Buches ist
        if (!auth()->user()->author) {
            abort(403, 'Sie haben keine Berechtigung, dieses Buch zu löschen.');
        }

        // Lösche das Buch
        $book->delete();

        return redirect()->route('books.index')->with('success', 'Buch erfolgreich gelöscht.');
    }

    public function search(Request $request)
    {
        // Extrahiere die Suchanfrage aus der Anfrage
        $query = $request->input('query');

        // Suche nach Büchern, deren Titel, Beschreibung oder Autor die Suchanfrage enthalten
        $books = Book::where('title', 'like', "%$query%")
                     ->orWhere('description', 'like', "%$query%")
                     ->orWhere('author', 'like', "%$query%")
                     ->get();

        return view('books.index', compact('books'));
    }
}

