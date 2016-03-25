<?php namespace App\Http\Controllers\Admin;

use App\Models\Book;
use App\Models\Author;
use Illuminate\Http\Request;
use App\Http\Requests\BookRequest;
use App\Repositories\BookRepository;
use App\Http\Controllers\Controller;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Http\RedirectResponse;

class BooksController extends Controller{

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
        $per_page = 3;
        $books = $this->books->allPaginated($per_page);
        $lastPage = $books->toArray()["last_page"];
        $page = $request->get('page');
        if (is_null($page)) {
            $page = 1;
        }
        $response = [
            'current_page' => $books->toArray()['current_page'],
            'last_page' => $books->toArray()['last_page'],
            'per_page' => $books->toArray()['per_page'],
            'prev_page_url' => $books->toArray()['prev_page_url'],
            'next_page_url' => $books->toArray()['next_page_url'],
            'data' => []
        ];
        foreach ($books as $key => $value) {
            $book = [
                'id' => $value->id,
                'title' => $value->title,
                'author' => $value->user->name,
                'year' => $value->year,
                'isbn' => $value->isbn,
            ];
            array_push($response['data'], $book); 
        }
        if($request->ajax())
        {
            return json_encode($response);
        }
        return view('admin.books.index', compact('response','page','lastPage'));
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
        return json_encode('ok');
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
        $authors = Author::all();
        return view('admin.books.edit', compact('book','authors'));
    }

    public function update(Book $book, BookRequest $request)
    {
        $this->books->update($book->id, $request->all());
        return json_encode('ok');
    }

	/**
	 * Remove the specified book from storage.
	 *
	 * @param Book $book
	 * @param Request $request
	 * @return Response
	 */
    public function destroy(Book $book)
    {
    	$book->delete();
        return json_encode('ok');
    }

}