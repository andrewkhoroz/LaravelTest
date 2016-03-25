<?php 
use Symfony\Component\HttpFoundation\Exception\HttpException;

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/
Route::group(['middleware' => ['web']], function () {

	Route::any( '(.*)', function( $page ){
	    dd($page);
	});

    Route::get('/', function () {
        return view('welcome');
    });

	// admin routes
	Route::group(['prefix' => 'admin', 'namespace' => 'Admin'], function ()
	{	
		// books page
		Route::resource('books', 'BooksController');
	});

});
