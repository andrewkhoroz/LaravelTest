<?php

namespace App\Http\Controllers;

use DB;
use Illuminate\Http\Request;
use App\Book;
use App\Author;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use Session;


class BookController extends Controller
{
    /**
     * Add Book
     *
     * @return \Illuminate\Http\Response
     */
    public function saveBook( Request $request ) {
        $this->validate( $request, [
            'title'  => 'required',
            'author_id'   => 'required',
            'year'       => 'required|numeric',
            'isbn'    => 'required',
            ] );


        Book::create( [
            'title'             => $request['title'],
            'author_id'         => $request['author_id'],
            'year'              => $request['year'],
            'isbn'              => $request['isbn'],

            ] );


        Session::flash('message', 'Book succesfully added.'); 
        $books = Book::with('author')->get();
        return view( 'book.index', ['books' => $books] );

    }


    public function showBooks() {
        $books = Book::with('author')->get();
        return view( 'book.index', ['books' => $books] );
    }


    public function deleteBook( Request $request ) {
            $bookId = $request->get( 'bookId' );
            Book::where( 'id', $bookId )->first()->delete();
            die();
    }

    public function addBook() {

        $book = new Book;

        $authors = Author::lists('name', 'id');
        
        return view( 'book.edit', ['book' => $book, 'authors' => $authors] );

    }

    public function editBook( $bookId ) {

        $book = Book::with('author')->where( 'id', $bookId )->first();

        $authors = Author::lists('name', 'id');
        
        return view( 'book.edit', ['book' => $book, 'authors' => $authors] );

    }
    public function updateBook( $bookId, Request $request ) {

        $this->validate( $request, [
            'title'  => 'required',
            'author_id'   => 'required',
            'year'       => 'required|numeric',
            'isbn'    => 'required',
            ] );

        $input = $request->all();

        $book = Book::with('author')->where( 'id', $bookId )->first();
        $book->title = $input['title'];
        $book->author_id = $input['author_id'];
        $book->year = $input['year'];
        $book->isbn = $input['isbn'];

        $book->push();

        Session::flash('message', 'Book succesfully updated.'); 
        $books = Book::with('author')->get();
        return view( 'book.index', ['books' => $books] );

    }
}
