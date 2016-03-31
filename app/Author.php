<?php

namespace App;


use Illuminate\Database\Eloquent\Model;

use App\Book;

//------------------------------------------------------------------------------

class Author extends Model
{
    
//------------------------------------------------------------------------------
    
    protected $table = 'author';
    public $timestamps = false;

//------------------------------------------------------------------------------
    
    public static function addNewAuthor($request)
    {
        $author = new Author;
        $author->name = $request['author'];
        $author->email = $request['email'];
        $author->phone = $request['phone'];
        $author->save();
    }

//------------------------------------------------------------------------------
    
    public static function authorHasBooks($author)
    {
        $books = Book::all();
        foreach($books as $book)
        {
            if($book['author']==$author)
            {
                return true;
            }
        }
        Author::where('name', '=', $author)->delete();
        return false;
    }

//------------------------------------------------------------------------------
    
    public static function isAuthor($name)
    {
       $authors = Author::all();
       foreach($authors as $temp_author)
       {
           if($temp_author['name'] == $name)
           {
               return true;
           }
       }
       return false;
    } 
    
//------------------------------------------------------------------------------
    
}

//------------------------------------------------------------------------------
