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
	Route::post('login', 'Auth\LoginClientController@login')->name('client.login');
	Route::post('logout', 'Auth\LoginClientController@logout')->name('client.logout');
	Route::post('register', 'Auth\RegisterClientController@register')->name('client.register');
	Route::post('verify', 'Auth\RegisterClientController@verifyEmail')->name('client.register.verify');
	Route::post('password-verify-email', 'Auth\ForgotClientPasswordController@verifyEmail')->name('client.password.verify');
	Route::post('send-reset-email','Auth\ForgotClientPasswordController@sendResetLinkEmail')->name('çlient.password.send-reset');
	Route::get('reset','Auth\ForgotClientPasswordController@sendResetLinkEmail')->name('çlient.password.send-reset');
});




Route::group(['prefix'=>'backend'],function(){

	Route::get('/',function(){})->middleware('guest:is_admin');

	// Authentication Routes...
    Route::get('login', 'Auth\LoginAdminController@showLoginForm')->name('login');
    Route::post('login', 'Auth\LoginAdminController@login');
    Route::post('logout', 'Auth\LoginAdminController@logout')->name('logout');
    //resources
	Route::resource('/users', 'UserController');
	Route::resource('/clients', 'ClientController');
	Route::resource('/memberships', 'MembershipController');
	Route::resource('/misses', 'MissController');
	Route::resource('/tickets-vote', 'TicketVoteController');
	Route::post('/upload-photo', 'MissController@uploadPhoto');
	Route::post('/delete-photo', 'MissController@deletePhoto');
});


