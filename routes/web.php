<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('layouts.frontend');
});

Route::group(['prefix'=>'auth'],function(){
	Route::post('login', 'Auth\LoginClientController@login');
	Route::post('logout', 'Auth\LoginClientController@logout')->name('logout');
});




Route::group(['prefix'=>'backend'],function(){
	Route::get('/',function(){
		if (Auth::guest()) return redirect('/backend/login');
		return redirect('/backend/users'); 
	});

	// Authentication Routes...
    Route::get('login', 'Auth\LoginAdminController@showLoginForm')->name('login');
    Route::post('login', 'Auth\LoginAdminController@login');
    Route::post('logout', 'Auth\LoginAdminController@logout')->name('logout');
    //resources
	Route::resource('/users', 'UserController');
	Route::resource('/clients', 'ClientController');
	Route::resource('/misses', 'MissController');
	Route::resource('/vote-tickets', 'VoteTicketController');
	Route::post('/upload-photo', 'MissController@uploadPhoto');
	Route::post('/delete-photo', 'MissController@deletePhoto');
});


