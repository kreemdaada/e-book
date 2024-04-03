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
        //debugger
        #dd($books);
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
                $book->author = $request->input('author');
                $book->description = substr($request->input('description'), 0, 255); // Beschreibung auf maximal 255 Zeichen kürzen
                $book->author_id = $author->id;
    
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
    #-------------------------------------------------------------------------------------------------
    public function edit($id)
    {
        $book = Book::findOrFail($id);

        // Überprüf, ob der angemeldete Benutzer der Autor des Buches ist
        if ($book->author_id != auth()->user()->id) {
            abort(403, 'Sie haben keine Berechtigung, dieses Buch zu bearbeiten.');
        }
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
        //Überprüf, ob der angemeldete Benutzer der Autor des Buches ist
        if ($book->author_id != auth()->user()->id) {
            abort(403, 'Sie haben keine Berechtigung, dieses Buch zu bearbeiten.');
        }
        return redirect()->route('books.index');
    }

    public function search(Request $request)
{
    // Extract the search query from the request
    $query = $request->input('query');

    // Search for books where the title, description, or author column contains the search query
    //  % signs in SQL, allowing the query to match any characters before or after the search query
    // This allows for partial matches, for example, if the search query is 'book', it will match 'book', 'books', 'ebook', etc.
    $books = Book::where('title', 'like', "%$query%")
                 ->orWhere('description', 'like', "%$query%")
                 ->orWhere('author', 'like', "%$query%")
                 ->get();

    return view('books.index', compact('books'));
}

}
