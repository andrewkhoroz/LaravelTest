<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Books;
use App\Authors;
use Illuminate\Support\Facades\Session;


class BookController extends Controller
{
    public function __construct()
    {

    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $books = Books::all();
        return view('books.index')->with('books', $books);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $authors = Authors::lists('name', 'id');
        return view('books.create')->with('authors', $authors);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'title' => 'required|min:3',
            'author' => 'required',
            'year' => 'required|numeric|min:3',
            'isbn' => 'required',
        ]);

        $book = new Books();
        $book->title = $request->title;
        $book->author = $request->author;
        $book->year = $request->year;
        $book->isbn = $request->isbn;
        $book->save();

        Session::flash('message', 'New Book created !');
        Session::flash('alert-class', 'alert-success');
        return redirect('books');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $book = Books::findorFail($id);
        return view('books.show')->with('book', $book);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $authors = Authors::lists('name', 'id');
        $book = Books::findorFail($id);
        return view('books.edit')->with('book', $book)->with('authors', $authors);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'title' => 'required|min:3',
            'author' => 'required',
            'year' => 'required|numeric|min:3',
            'isbn' => 'required',
        ]);

        $book = Books::findorFail($id);
        $book->title = $request->title;
        $book->author = $request->author;
        $book->year = $request->year;
        $book->isbn = $request->isbn;
        $book->save();

        Session::flash('message', 'Book updated successfully !');
        Session::flash('alert-class', 'alert-success');
        return redirect('books');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $book = Books::findorFail($id);
        if ($book->delete()) {
            Session::flash('message', 'Book deleted successfully !');
            Session::flash('alert-class', 'alert-success');
            return redirect('books');
        } else {

            Session::flash('message', 'Unable to delete Book !');
            Session::flash('alert-class', 'alert-danger');
            return redirect('books');
        }
    }
}
