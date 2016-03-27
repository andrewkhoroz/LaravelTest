<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Book extends Model
{

    protected $table = 'book';

    protected $fillable = ['title','author_id', 'year', 'isbn'];

    public function author()
    {
        return $this->belongsTo('App\Author');
    }
}
