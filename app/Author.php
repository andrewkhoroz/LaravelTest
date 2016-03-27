<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Author extends Model
{

    protected $table = 'author';

    protected $fillable = ['name','email','phone'];

    public function book()
    {
        return $this->hasOne('App\Book');
    }


}
