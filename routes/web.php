<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/

Auth::routes();
Route::group(['middleware' => 'auth'], function(){
	Route::get('/password', 'PasswordController@index');
	Route::post('/password', 'PasswordController@update');
	Route::get('profile', 'ProfileController@index');
});


Route::get('/', 'HomeController@index');
