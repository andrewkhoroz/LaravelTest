<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Book extends Model{
	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'books';

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = ['title', 'author_id', 'year', 'isbn'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(__NAMESPACE__ . '\\Author', 'author_id');
    }
}
