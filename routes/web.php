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
	Route::get('/new', 'PartyController@create');
	Route::post('/', 'PartyController@store');
	Route::get('/{id}', 'PartyController@show');
	Route::get('/{id}/dontattend', 'PartyController@dontAttend');
	Route::get('/{id}/invite', 'PartyController@showInvite');
	Route::post('/{id}/invite', 'PartyController@inviteUsers');
	Route::get('/{partid}/invite/{userid}', 'PartyController@invite');
	Route::get('/{id}/addtask', 'TaskController@create');
	Route::post('/{id}/storetask', 'TaskController@store');
	Route::get('/{id}/tasks', 'TaskController@index');
});

Route::group(['middleware' => 'auth', 'prefix' => 'task'], function(){
	Route::get('/{id}', 'TaskController@show');
	Route::get('/{id}/edit', 'TaskController@edit');
	Route::post('/{id}', 'TaskController@update');
	Route::get('/{id}/claim', 'TaskController@claim');
	Route::get('/{id}/delete', 'TaskController@delete');
});

Route::group(['middleware' => 'auth', 'prefix' => 'users'], function(){
	Route::get('/{id}', 'ProfileController@show')->name('profile');
});

Route::group(['middleware' => ['auth', 'admin'], 'prefix' => 'admin'], function(){
	Route::get('/', 'AdminController@index')->name('admin');
	Route::get('/users', 'AdminController@users')->name('admin.users');
	Route::post('/users/ban', 'AdminController@ban')->name('admin.ban');
	Route::get('/parties', 'AdminController@parties')->name('admin.parties');
	ROute::post('/parties/delete', 'AdminController@deleteParty')->name('admin.parties.delete');
});


Route::get('/', 'HomeController@index')->name('home');
