<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
 */

/**
 * Authentication Endpoints
 */
Route::prefix('auth')->group(function () {
    Route::post('register', 'AuthController@register');
    Route::post('login', 'AuthController@login');
    Route::get('refresh', 'AuthController@refresh');
    // User needs to have a token to use these routes
    Route::group(['middleware' => 'auth:api'], function () {
        Route::get('user', 'AuthController@user');
        Route::post('logout', 'AuthController@logout');
    });
});

/**
 * Search Endpoint
 */
Route::get('search', 'SearchController@search');
Route::get('listing', 'ListingsController@all');

/**
 * Listing Resource Routes
 * User must be logged in to access them
 */
Route::group(['middleware' => 'auth:api'], function () {
    Route::get('/user-listings', 'ListingsController@getUserListings');
    Route::get('/user-favorites', 'ListingsController@getUserFavorites');
    Route::post('/listing/create', 'ListingsController@store');
    Route::patch('/listing', 'ListingsController@update');
    Route::post('/listing/favorite', 'ListingsController@favorite');
    Route::post('/listing/unfavorite', 'ListingsController@unfavorite');
    Route::delete('/listing', 'ListingsController@destroy');
});
/**
 * Communications Routes
 * User must be logged in to access them
 */
Route::group(['middleware' => 'auth:api'], function () {
    Route::get('/conversations', 'CommunicationsController@getAllConversations')->name('convo.getAll');
    Route::get('/conversation/messages', 'CommunicationsController@getAllMessages')->name('message.getAll');
    Route::post('/conversation/create', 'CommunicationsController@createConversation')->name('convo.create');
    Route::post('/conversation/add-participants', 'CommunicationsController@addConversationParticipants')->name('convo.add-participants');
    Route::post('/message/send', 'CommunicationsController@sendMessage')->name('message.send');

});
/**
 * Upload Resource Routes
 * Once again the User must be logged in to use them
 */
Route::group(['middleware' => 'auth:api'], function () {
    Route::get('/upload', 'UploadsController@getAll');
    Route::post('/upload', 'UploadsController@store');
    Route::delete('/upload/delete', 'UploadsController@destroy');
});


