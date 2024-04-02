<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Comment;

class CommentController extends Controller
{
    public function addComment(Request $request, $bookId)
    {
        // Validiere die Eingaben
        $validatedData = $request->validate([
            'comment' => 'required|max:255', // 'comment' 
        ]);

        // Erstelle einen neuen Kommentar
        $comment = new Comment();
        $comment->user_id = auth()->id();
        $comment->book_id = $bookId;
        $comment->content = $validatedData['comment']; // Verwende 'content' statt 
        $comment->save(); // Speichere den Kommentar

        // Optional: Feedback an den Benutzer
        return redirect()->back()->with('success', 'Kommentar erfolgreich hinzugefügt.');
    }
}

