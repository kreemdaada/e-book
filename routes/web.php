<?php
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AboutController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\LikeController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\PDFController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

//Route
Route::get('/register', [AuthController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [AuthController::class, 'register']);
#--------------------------------------------------------------------------
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
#------------------------------------------------------
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
#---------------------------------------------------
Route::get('/home', [HomeController::class, 'index'])->name('home.index');
#----------------------------------------------
Route::get('/about', [AboutController::class, 'index'])->name('about.index');
#------------------------------------------------------
Route::group(['middleware' => 'web'], function () {
    Route::get('/books', [BookController::class, 'index'])->name('books.index');
});

Route::group(['middleware' => 'author'], function () {
    Route::get('/books/create', [BookController::class, 'create'])->name('books.create');
    Route::post('/books', [BookController::class, 'store'])->name('books.store');
    Route::get('/books/{id}/edit', [BookController::class, 'edit'])->name('books.edit');
    Route::put('/books/{id}', [BookController::class, 'update'])->name('books.update');
    Route::delete('/books/{id}', [BookController::class, 'destroy'])->name('books.destroy');
});


#------------------------------------------------------
Route::post('/like/{bookId}', [LikeController::class, 'like'])->name('like');
Route::post('/comment/{bookId}', [CommentController::class, 'addComment'])->name('comment');
#---------------------------------------------------------------------------
Route::get('/books/{bookId}/comments', 'BookController@showBookComments');
#---------------------------------------------------------------------------
Route::get('/download-pdf', [PDFController::class, 'downloadPDF'])->name('pdf.download');
