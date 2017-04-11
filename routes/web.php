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

Route::get('/', 'WebsiteController@index')->name('website.home');
Route::get('/miss/{slug}', 'WebsiteController@show')->name('website.miss.show');


Route::group(['prefix'=>'account'],function(){
	Route::get('/','WebsiteController@myAccount')->name('website.account')->middleware('auth');
	Route::post('/update','WebsiteController@updateAccount')->name('website.account.update')->middleware('auth');
	Route::post('subscribe','PaymentController@subscribe')->name('website.subscribe')->middleware('auth');
	Route::post('ticket','PaymentController@buyTicket')->name('website.buyticket')->middleware('auth');
});

// votes for miss
Route::post('/miss/vote', 'VoteController@store')->name('website.miss.vote.store');


Route::group(['prefix'=>'auth'],function(){
	// login
	Route::post('login', 'Auth\LoginClientController@login')->name('client.login');
	Route::post('logout', 'Auth\LoginClientController@logout')->name('client.logout');
	
	// register
	Route::post('register', 'Auth\RegisterClientController@register')->name('client.register');
	
	// activate account
	Route::get('activate/{activationCode}','Auth\ActivateClientController@activateAccount')->name('client.register.activate');
	Route::post('activate','Auth\ActivateClientController@reSendactivationCode')->name('client.re-send-activate');

	// forgot and change password
	Route::post('send-reset-email','Auth\ForgotClientPasswordController@sendResetLinkEmail');
	Route::get('reset/{token}','Auth\ResetClientPasswordController@showResetForm');
	Route::post('/password/reset','Auth\ResetClientPasswordController@reset');
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
	Route::resource('/activities', 'ClientActivityController',['only'=>['index']]);
	Route::post('/upload-photo', 'MissController@uploadPhoto');
	Route::post('/delete-photo', 'MissController@deletePhoto');
});


