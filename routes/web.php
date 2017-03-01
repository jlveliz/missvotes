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
    return view('welcome');
});


Route::group(['prefix'=>'backend'],function(){
	Auth::routes();
	Route::get('/',function(){
		if (Auth::guest()) return redirect('/backend/login');
		return redirect('/backend/users'); 
	});

	Route::resource('/users', 'UserController');
	// Route::resource('/clients', 'UserController');
	// Route::resource('/misses', 'UserController');
});


