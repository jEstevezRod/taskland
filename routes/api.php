<?php

use Illuminate\Http\Request;


Route::group(['prefix' => 'auth'], function () {

//Route::prefix('auth')->group(function () {

    Route::get('/login/{social}', 'Web\AuthenticationController@getSocialRedirect');

    Route::get('/login/{social}/callback', 'Web\AuthenticationController@getSocialCallback');

    Route::post('/newUser', 'API\RegisterController@register');

    Route::get('/loadUserWithoutPass', 'Web\AuthenticationController@loadUserWithoutPass');

    Route::post('/loginUser', 'API\UsersController@getLoginUser');

    Route::get('/user', 'API\UsersController@me');

    Route::get('/userCheckPass', 'API\UsersController@getUserCheckPass');

    Route::put('/setPassword', 'API\UsersController@postFirstPassword');

    Route::post('/logoutUser', 'API\UsersController@logout');


    Route::get('/tasks', 'API\TasksController@getTasks');

    Route::get('/tasks/{id}', 'API\TasksController@getTask');

    Route::post('/tasks', 'API\TasksController@postNewTask');
});
