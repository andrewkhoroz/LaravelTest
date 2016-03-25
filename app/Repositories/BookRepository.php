<?php namespace App\Repositories;

use App\Models\Book;

class BookRepository extends Repository {
    
    protected $sortColumn = "id";
    
    /**
     * @param Book $book
     */
    public function __construct(Book $book)
    {
        parent::__construct($book);
    }

    /**
     * Create new book
     * @param $data
     */
    public function store(array $data)
    {
        $book = Book::firstOrCreate([
            'title' => $data['title'],
            'author_id' => $data['author_id'],
            'year' => $data['year'],
            'isbn' => $data['isbn']
            ]);
        $book->save();
    }

    /**
     * Update book object
     * @param $id
     * @param $data
     */
    public function update($id, array $data)
    {
        /**
         * Find the book or fail. The exception is handled by the controller.
         */
        $book = $this->findOrFail($id);

        $book->update($data);
    }
}