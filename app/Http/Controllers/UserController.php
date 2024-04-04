<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Book;
use App\Models\Comment;
use App\Models\Like;
use App\Models\Download;
class UserController extends Controller
{
    public function profile()
    {
        $user = Auth::user();
        $comments = Comment::where('user_id', $user->id)->get();
        $downloadedBooks = $user->downloadedBooks;
        $downloadedBooksCount = $downloadedBooks->count();

        return View('user.profile', [
            'user' => $user,
            'comments' => $comments,
            'downloadedBooks' => $downloadedBooks,
            'downloadedBooksCount' => $downloadedBooksCount,
        ]);
    }
}
