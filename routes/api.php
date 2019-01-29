<?php

use Illuminate\Http\Request;


Route::group(['prefix' => 'auth'], function () {

//Route::prefix('auth')->group(function () {

    // For user and auth

    Route::get('/login/{social}', 'Web\AuthenticationController@getSocialRedirect');

    Route::get('/login/{social}/callback', 'Web\AuthenticationController@getSocialCallback');

    Route::post('/newUser', 'API\RegisterController@register');

    Route::get('/loadUserWithoutPass', 'Web\AuthenticationController@loadUserWithoutPass');

    Route::post('/loginUser', 'API\UsersController@getLoginUser');

    Route::get('/user', 'API\UsersController@me');

    Route::get('/userCheckPass', 'API\UsersController@getUserCheckPass');

    Route::put('/setPassword', 'API\UsersController@postFirstPassword');

    Route::post('/logoutUser', 'API\UsersController@logout');

    Route::get('/loginUserWithToken', 'API\AuthenticationController@loadUserWithoutPass');

    //specials

//    Route::post('/login/{driver}', 'Web\AuthenticationController@getSocialRedirect');
//
//    Route::post('/login/{driver}/callback', 'Web\AuthenticationController@getSocialCallback');

    //For tasks

    Route::get('/loadTasks/{id}', 'API\TaskController@getTasks');

    Route::post('/changeStatus/{id}', 'API\TaskController@update');

    Route::get('/countTasks', 'API\TaskController@countTasks' );


    /*Route::get('/tasks/{id}', 'API\TaskController@getTask'); */

    Route::post('/tasks', 'API\TaskController@postNewTask');

    //For teams

    Route::post('/newTeam', 'API\TeamController@postNewTeam');

    Route::get('/loadTeams', 'API\TeamController@loadTeams');

    // For teammember

    Route::post('/addTeamMember', 'API\ManageMembers@new');

    // For projects

    Route::post('/newProject', 'API\ProjectController@store');

    Route::get('/loadProjects', 'API\ProjectController@index');

    Route::get('loadProjectName/{id}','API\ProjectController@getName' );

    // For new User in Project

    Route::post('/addNewUserInProject', 'API\ProjectUserController@store');

    // For States

    Route::post('/addNewState', 'API\StateController@store');

    Route::get('/loadStates/{id}', 'API\StateController@index');

    Route::delete('/deleteState/{id}','API\StateController@delete');


});
