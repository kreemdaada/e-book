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
        $this->middleware(AuthorMiddleware::class)->except('index', 'show');
    }

    public function index()
    {
        $books = Book::with('author')->get(); // Lade auch den Autor für jedes Buch
        return view('books.index', compact('books'));
    }

    public function create()
    {
        $author = Author::all(); 
        return view('books.create', compact('author')); 
    }

    public function store(Request $request)
    {
        // Überprüfen, ob der aktuelle Benutzer ein Autor ist
        if (auth()->user()->author) {
            $authorName = $request->input('author');
            
            // Sicherstellen, dass der Autorname nicht leer ist
            if (!empty($authorName)) {
                $author = Author::firstOrCreate(['name' => $authorName]); // Erstelle den Autor, falls nicht vorhanden
    
                $book = new Book();
                $book->title = $request->input('title');
                $book->description = $request->input('description');
                $book->author_id = $author->id; // Setze die author_id entsprechend
    
                $book->save();
    
                return redirect()->route('books.index');
            } else {
                // Wenn der Autorname fehlt, zeige eine Fehlermeldung an oder leite ihn an eine andere Seite weiter
                return redirect()->back()->withErrors('Autorname fehlt.');
            }
        } else {
            // Wenn der Benutzer kein Autor ist, zeige eine Fehlermeldung an oder leite ihn an eine andere Seite weiter
            return redirect()->back()->withErrors('Nur Autoren dürfen Bücher erstellen.');
        }
    }
    
    public function edit($id)
    {
        $book = Book::findOrFail($id);
        return view('books.edit', compact('book'));
    }

    public function update(Request $request, $id)
    {
        $data = $request->except(['_token']);
        $book = Book::findOrFail($id);
        $book->update($data);
        return redirect()->route('books.index');
    }

    public function destroy($id)
    {
        $book = Book::findOrFail($id);
        $book->delete();
        return redirect()->route('books.index');
    }
}
