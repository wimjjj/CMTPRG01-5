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
	Route::get('/profile', 'ProfileController@index');
	Route::get('/profile/edit', 'ProfileController@edit');
	Route::post('/profile', 'ProfileController@update');
});

Route::group(['middleware' => 'auth', 'prefix' => 'party'], function(){
	Route::post('/', 'PartyController@create');
	Route::get('/{id}', 'PartyController@show');
	Route::get('/{id}/attend', 'PartyController@attend');
	Route::get('/{id}/dontatted', 'PartyController@dontAttend');
});

Route::group(['middleware' => 'auth', 'prefix' => 'users'], function(){
	Route::get('/{id}', 'ProfileController@show');
});


Route::get('/', 'HomeController@index');
