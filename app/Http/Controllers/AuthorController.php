<?php

namespace App\Http\Controllers;


use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Authors;
use App\Books;

class AuthorController extends Controller
{
    public function __construct()
    {

    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $authors = Authors::all();
        return view('authors.index')->with('authors', $authors);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('authors.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|min:3',
            'email' => 'required|email',
            'phone' => 'required|phone:US',
        ]);

        $author = new Authors();
        $author->name = $request->name;
        $author->email = $request->email;
        $author->phone = $request->phone;
        $author->save();

        Session::flash('message', 'New Author created !');
        Session::flash('alert-class', 'alert-success');
        return redirect('authors');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $author = Authors::findorFail($id);
        return view('authors.show')->with('author', $author);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $author = Authors::findorFail($id);
        return view('authors.edit')->with('author', $author);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required|min:3',
            'email' => 'required|email',
            'phone' => 'required|phone:US',
        ]);

        $author = Authors::findorFail($id);
        $author->name = $request->name;
        $author->email = $request->email;
        $author->phone = $request->phone;
        $author->save();

        Session::flash('message', 'Author updated successfully !');
        Session::flash('alert-class', 'alert-success');
        return redirect('authors');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $books = Books::where('author', '=', $id)->count();

        if ($books <> 0) {
            Session::flash('message', 'Unable to delete Author - attached to at least one Book !');
            Session::flash('alert-class', 'alert-danger');
            return redirect('authors');
        }

        $author = Authors::findorFail($id);
        if ($author->delete()) {
            Session::flash('message', 'Author deleted successfully !');
            Session::flash('alert-class', 'alert-success');
            return redirect('authors');
        } else {

            Session::flash('message', 'Unable to delete Author !');
            Session::flash('alert-class', 'alert-danger');
            return redirect('authors');
        }
    }
}
