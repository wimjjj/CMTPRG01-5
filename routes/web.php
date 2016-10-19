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

Route::group(['middleware' => ['auth', 'banned']], function(){
	Route::get('/password', 'PasswordController@index')->name('password');
	Route::post('/password', 'PasswordController@update')->name('password');
	Route::get('/profile', 'ProfileController@index')->name('profile.me');
	Route::get('/profile/edit', 'ProfileController@edit')->name('profile.edit');
	Route::post('/profile', 'ProfileController@update')->name('profile.me');
	Route::get('/', 'HomeController@index')->name('home');
});

Route::group(['middleware' => ['auth', 'banned'], 'prefix' => 'party'], function(){
	Route::get('/new', 'PartyController@create')->name('party.new');
	Route::post('/', 'PartyController@store')->name('party.store');
	Route::get('/{id}', 'PartyController@show')->name('party.show');
	Route::get('/{id}/dontattend', 'PartyController@dontAttend')->name('party.leave');
	Route::get('/{id}/invite', 'PartyController@showInvite')->name('party.invite');
	Route::post('/{id}/invite', 'PartyController@inviteUsers')->name('party.invite');
	//CHANCE TO POST
	Route::get('/{partyid}/invite/{userid}', 'PartyController@invite')->name('party.invite.send');	
	Route::get('/{id}/addtask', 'TaskController@create')->name('party.tasks.new');
	Route::post('/{id}/storetask', 'TaskController@store')->name('party.tasks.store');
	Route::get('/{id}/tasks', 'TaskController@index')->name('party.tasks');
});

Route::group(['middleware' => ['auth', 'banned'], 'prefix' => 'task'], function(){
	Route::get('/{id}', 'TaskController@show')->name('task.show');
	Route::get('/{id}/edit', 'TaskController@edit')->name('task.edit');
	Route::post('/{id}', 'TaskController@update')->name('task.update');
	Route::get('/{id}/claim', 'TaskController@claim')->name('task.claim');
	Route::get('/{id}/delete', 'TaskController@delete')->name('task.delete');		//CHANCE TO POST
});

Route::group(['middleware' => ['auth', 'banned'], 'prefix' => 'users'], function(){
	Route::get('/{id}', 'ProfileController@show')->name('profile');
});

Route::group(['middleware' => ['auth', 'admin', 'banned'], 'prefix' => 'admin'], function(){
	Route::get('/', 'AdminController@index')->name('admin');
	Route::get('/users', 'AdminController@users')->name('admin.users');
	Route::post('/users/ban', 'AdminController@ban')->name('admin.ban');
	Route::get('/parties', 'AdminController@parties')->name('admin.parties');
	Route::post('/parties/delete', 'AdminController@deleteParty')->name('admin.parties.delete');
	Route::post('resetpassword', 'AdminController@resetPassword')->name('admin.resetpassword');
});




Route::get('/banned', 'HomeController@banned')->name('banned');
