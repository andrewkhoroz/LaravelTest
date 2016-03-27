<?php

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

Route::get( '/', 'BookController@showBooks' );

Route::post( '/delete-book', 'BookController@deleteBook' );

Route::get( '/edit-book/{id}', 'BookController@editBook' );
Route::post( '/edit-book/{id}', 'BookController@updateBook' );

Route::get( '/add-book', 'BookController@addBook' );
Route::post( '/add-book', 'BookController@saveBook' );
