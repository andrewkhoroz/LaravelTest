<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

//------------------------------------------------------------------------------

class Book extends Model
{
    
//------------------------------------------------------------------------------
    
    protected $table = 'book'; 
    protected $fillable = [
        'title', 'author', 'year', 'isbn'
    ];
    public $timestamps = false;
    
//------------------------------------------------------------------------------
    
    public static function isIsbn($isbn)
    {
       $books = Book::all();
       foreach($books as $temp_book)
       {
           if($temp_book['isbn'] == $isbn)
           {
               return true;
           }
       }
       return false;
    }
    
//------------------------------------------------------------------------------    
    
}

//------------------------------------------------------------------------------
