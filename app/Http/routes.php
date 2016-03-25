<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/
use App\Books;
use Illuminate\Support\Facades\DB;

Route::group(['middleware' => ['web']], function () {

    Route::get('/', function () {
        return view('home');
    });

    Route::post('books/getlist', function() {
        $books = DB::table('books')
            ->join('authors', 'books.author', '=', 'authors.id')
            ->select('books.*', 'authors.name as author_name')
            ->whereNull('books.deleted_at')
            ->get();
        return $books;
    });

    Route::resource('/authors', 'AuthorController');
    Route::resource('/books', 'BookController');

});
