<?php
namespace App\Http\Controllers;

use App\Models\Like;
use Illuminate\Http\Request;

class LikeController extends Controller
{
    public function like(Request $request, $bookId)
    {
        $like = new Like();
        $like->user_id = auth()->id();
        $like->book_id = $bookId;
        $like->save();

        // Zähle die Likes für das Buch neu
        $bookLikes = Like::where('book_id', $bookId)->count();

        // Aktualisiere die Daten in der Home-Ansicht
        return view('home.index')->with('bookLikes', $bookLikes);
    }
}