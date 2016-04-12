<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Book;
use App\Author;

//------------------------------------------------------------------------------

class BookShelfController extends Controller
{
    
//------------------------------------------------------------------------------
    
    public function index()
    {
        $books = Book::all();
        return view('book_shelf.index',['books'=>$books]);
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
        return view('book_shelf.edit',['book'=>$book]);
    }

//------------------------------------------------------------------------------ 
    
    public function update(Request $request)
    {
        $this->validate($request, [
            'title' => 'required|min:2',
            'author' => 'required',
            'year' => 'required|numeric|min:3',
            'isbn' => 'required',
        ]);
            if(Author::isAuthor($request['author']) == false)
                {
                    Author::addNewAuthor($request); 
                }
                else{
                    Author::where('name','=',$request['author'])->update(
                                 ['email' => $request['email'],
                                  'phone' => $request['phone']  
                                 ]); 
                    }
        $author = Author::where('name','=',$request['author'])->firstOrFail();
        Book::where('id', '=', $request['id'])->update(
                    ['title' => $request['title'],
                     'year' => $request['year'],
                     'isbn' => $request['isbn'],
                     'author_id' => $author['id']
                    ]);    
        return "OK";
    }
    
//------------------------------------------------------------------------------    
 
    public function add()
    {
        return view('book_shelf.add');
    }
           
//------------------------------------------------------------------------------    
    
    public function store(Request $request)
    {
       $this->validate($request, [
            'title' => 'required|min:2',
            'author' => 'required',
            'year' => 'required|numeric|min:3',
            'isbn' => 'required',
        ]);
       if(Author::isAuthor($request['author']) == false)
       {
           Author::addNewAuthor($request); 
       }
       $author = Author::where('name','=',$request['author'])->firstOrFail();
       $book = new Book;
       $book->title = $request['title'];
       $book->author_id = $author->id;
       $book->year = $request['year'];
       if(Book::isIsbn($request['isbn'])==true)
       {
           return "ISBN already exist! Please enter another ISBN!";
       }
       else
       {
           $book->isbn = $request['isbn'];
           $book->save();
        }
    return "OK";
    }
    
//------------------------------------------------------------------------------    
    
}

//------------------------------------------------------------------------------
