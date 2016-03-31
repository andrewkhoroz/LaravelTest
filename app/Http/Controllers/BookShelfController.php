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
       $isbn  = $request['isbn'];
       $book = Book::where('isbn','=',$isbn)->firstOrFail();          
       Book::where('isbn', '=', $isbn)->delete();
       Author::authorHasBooks($book['author']);
       return "OK";  
           
    }

//------------------------------------------------------------------------------    
    
    public function edit(Request $request)
    {
        $isbn = $request['isbn'];
        $book = Book::where('isbn', '=', $isbn)->firstOrFail();
        $author = Author::where('name','=',$book['author'])->firstOrFail();
        return view('book_shelf.edit',['book'=>$book,'author'=>$author]);
    }

//------------------------------------------------------------------------------ 
    
    public function update(Request $request)
    {
        Book::where('isbn', '=', $request['oldIsbn'])->update(
                    ['title' => $request['title'],
                     'author' => $request['author'],
                     'year' => $request['year'],   
                    ]);
        if($request['isbn']!=$request['oldIsbn'])
        {
            if(Book::isIsbn($request['isbn']) == true)
            {
                return "ISBN already exist! Please enter another ISBN!";
            }
        }
        Book::where('isbn', '=', $request['oldIsbn'])->update(
                   ['isbn' => $request['isbn']]);
        if($request['author']!=$request['oldAuthor'])
        {
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
        }
        else{
            Author::where('name','=',$request['oldAuthor'])->update(
                         ['email' => $request['email'],
                          'phone' => $request['phone']  
                         ]);
            }
        Author::authorHasBooks($request['oldAuthor']);    
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
       $book = new Book;
       $book->title = $request['title'];
       $book->author = $request['author'];
       $book->year = $request['year'];
       if(Book::isIsbn($request['isbn'])==true)
       {
           return "ISBN already exist! Please enter another ISBN!";
       }
       else{
           $book->isbn = $request['isbn'];
           $book->save();
       if(Author::isAuthor($request['author']) == false)
       {
           Author::addNewAuthor($request); 
       }
           }
    return "OK";
    }
    
//------------------------------------------------------------------------------    
    
}

//------------------------------------------------------------------------------
