<?php namespace App\Http\Controllers\Admin;

use App\Models\Book;
use App\Models\Author;
use Illuminate\Http\Request;
use App\Http\Requests\BookRequest;
use App\Repositories\BookRepository;
use Illuminate\Routing\Controller as BaseController;

class BookController extends BaseController{

    protected $books;

    public function __construct(BookRepository $bookRepository)
    {
        $this->books = $bookRepository;
    }

	/**
	 * Deisplay listing of books
	 * @param Request $request
	 * @return Response
	 */
    public function index(Request $request)
    {
        $books = $this->books->searchOrAllPaginated($request->except(['page']));
        return view('admin.book.index', compact('books'));
    }

	/**
	 * Show the form for creating a new book
	 *
	 * @param Request $request
	 * @return Response
	 */
    public function create()
    {
        $authors = Author::all();
        return view('admin.books.create', compact('authors'));
    }

	/**
	 * Store a newly created book in storage.
	 *
	 * @param BookRequest $request
	 * @return Response
	 */
    public function store(BookRequest $request)
    {
        $this->books->store($request->all());
        return $this->redirect('books.index');
    }

	/**
	 * Show the form for editing the specified book.
	 *
	 * @param Book $book
	 * @param Request $request
	 * @return Response
	 */
    public function edit(Book $book, Request $request)
    {
        return view('admin.books.edit', compact('book'));
    }

    public function update(Book $book, BookRequest $request)
    {
        $this->books->update($book->id, $request->all());
        return $this->redirect('books.index');
    }

	/**
	 * Remove the specified book from storage.
	 *
	 * @param Book $book
	 * @param Request $request
	 * @return Response
	 */
    public function destroy(Book $book, Request $request)
    {
    	$this->books->delete($book->id);
        return $this->redirect('books.index');
    }

}