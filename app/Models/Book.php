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

    // Definieren der Beziehung zu einem Autor
    public function author()
    {
        return $this->belongsTo(Author::class);
    }

    // Methode zum Speichern eines neuen Buches
    public static function createBook($title, $description, $authorName)
    {
        // Suchen nach einem vorhandenen Autor oder Erstellen eines neuen
        $author = Author::firstOrCreate(['name' => $authorName]);

        // Erstellen eines neuen Buchobjekts
        $book = new self();
        $book->title = $title;
        $book->description = $description;
        $book->author_id = $author->id; // Setzen der author_id auf die ID des Autors

        // Speichern des Buchobjekts in der Datenbank
        $book->save();

        // Rückgabe des gespeicherten Buchobjekts
        return $book;
    }
}
