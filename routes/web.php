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

Route::get('/', 'MainController@index');

// Route to handle page reload in Vue except for api routes
Route::get('/{any?}', 'MainController@index')->where('any', '^(?!api\/)[\/\w\.-]*');

/**
 * Authentication Routes
 */
//Auth::routes();
Route::get('auth/{provider}', 'Auth\SocialAccountsController@redirectToProvider');
Route::get('auth/{provider}/callback', 'Auth\SocialAccountsController@handleProviderCallback');

/**
 * Registration confirmation
 */
//Route::get('/register/confirm', 'Auth\RegisterConfirmationController@index')->name('register.confirm');

/**
 * User Resource Routes
 */
Route::get('/user/{user}/profile', 'UsersController@index');
Route::get('/user/{user}/listings', 'UsersController@showUserListings');
Route::get('/user/{user}', 'UsersController@show');
Route::get('/user/{user}/edit', 'UsersController@edit')->name('user.edit');
Route::patch('/user/{user}', 'UsersController@update')->name('user.update');
Route::delete('/user/{user}', 'UsersController@delete')->name('user.delete');


