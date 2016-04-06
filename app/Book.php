<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

//------------------------------------------------------------------------------

class Book extends Model
{
    
//------------------------------------------------------------------------------
    
    protected $table = 'books'; 
    protected $fillable = ['title', 'author_id', 'year', 'isbn'];
    
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
    
    public function author()
    {
        return $this->belongsTo('App\Author');
    }
    
}

//------------------------------------------------------------------------------
