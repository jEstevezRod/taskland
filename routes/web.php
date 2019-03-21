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

/* Root */

Route::get( '/', 'Web\AppController@getApp' )->name('app');


/* Login and Logout */



// Route::get('/login/{social}', 'Web\AuthenticationController@getSocialRedirect');

// Route::get('/login/{social}/callback', 'Web\AuthenticationController@getSocialCallback');

//Route::post('/login/{social}', 'Web\AuthenticationController@getSocialRedirect');


//Route::get( '/logout', 'Web\AppController@getLogout' )->name('logout');
//
//Route::post('/login', 'Web\AuthenticationController@getLogin' )->middleware('guest');

