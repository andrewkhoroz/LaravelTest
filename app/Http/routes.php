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



Route::group(['middleware' => ['web']], function () {
    Route::get('/','BookShelfController@index');
    Route::get('add','BookShelfController@add');
    Route::get('index','BookShelfController@index');
    Route::post('remove','BookShelfController@remove');
    Route::get('edit','BookShelfController@edit');
    Route::post('store','BookShelfController@store');
    Route::post('update','BookShelfController@update');
});
