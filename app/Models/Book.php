<?php


namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Author; 

class Book extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'author_id', // Spalte für die Beziehung zum Autor
        '_token', //  das _token Feld hinzu
    ];

    // Definier der Beziehung zu einem Autor
    public function author()
    {
        return $this->belongsTo(Author::class);
    }

    // Methode zum Speichern eines neuen Buches
    public static function createBook($title, $description, $authorName)
    {
        // Suche nach einem vorhandenen Autor oder Erstellen eines neuen
        $author = Author::firstOrCreate(['name' => $authorName]);

        // Erstelle eines neuen Buchobjekts
        $book = new self();
        $book->title = $title;
        $book->description = $description;
        $book->author_id = $author->id; // Setze der author_id auf die ID des Autors

        // Speicher des Buchobjekts in der Datenbank
        $book->save();

        // Rückgabe des gespeicherten Buchobjekts
        return $book;
    }

     /**
     * Get the likes for the book.
     */
    public function likes()
    {
        return $this->hasMany(Like::class);
    }

    public function like()
    {
        // hier Route für die Like-Aktion angeben
        return route('like', ['bookId' => $this->id]);
    }


    /**
     * Get the comments for the book.
     */
    public function comments()
    {
        return $this->hasMany(Comment::class);
    }
}
