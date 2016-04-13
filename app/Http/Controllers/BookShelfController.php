<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Book;
use App\Author;
use App\Http\Requests\CreateUpdateBookRequest;

//------------------------------------------------------------------------------

class BookShelfController extends Controller
{
    
//------------------------------------------------------------------------------
    
    public function index()
    {
        $book = Book::all();
        return view('book_shelf.index')->with('books', $book);
    }

//------------------------------------------------------------------------------
    
    public function remove(Request $request)
    { 
       Book::where('id', '=', $request['id'])->delete();
       return "OK";   
    }

//------------------------------------------------------------------------------    
    
    public function edit(Request $request)
    {
        $book = Book::where('id', '=', $request['id'])->firstOrFail();
        $authors = Author::lists('name', 'id');
        return view('book_shelf.edit')->with('book', $book)->with('authors', $authors);
        
    }

//------------------------------------------------------------------------------ 
    
    public function update(CreateUpdateBookRequest $request)
    {
        Book::where('id', '=', $request['id'])->update(
                ['title' => $request['title'],
                 'year' => $request['year'],
                 'isbn' => $request['isbn'],
                 'author_id' => $request['author']
                 ]);
        return redirect('index');
    }
    
//------------------------------------------------------------------------------    
 
    public function add()
    {
        $book = new Book;
        $authors = Author::lists('name', 'id');
        return view('book_shelf.add')->with('authors', $authors)->with('book',$book);
    }
           
//------------------------------------------------------------------------------    
    
    public function store(CreateUpdateBookRequest $request)
    {
       $book = new Book;
       $book->title = $request['title'];
       $book->author_id = $request['author'];
       $book->year = $request['year'];
       $book->isbn = $request['isbn'];
       $book->save();
       return redirect('index');
    }
    
//------------------------------------------------------------------------------    
    
}

//------------------------------------------------------------------------------
