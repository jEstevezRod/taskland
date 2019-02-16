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

    Route::get('/user/{id}','API\UsersController@getUser');


    //For tasks

    Route::get('/loadTasks/{id}', 'API\TaskController@getTasks');

    Route::post('/changeStatus/{id}', 'API\TaskController@update');

    Route::get('/countTasks', 'API\TaskController@countTasks' );


    /*Route::get('/tasks/{id}', 'API\TaskController@getTask'); */

    Route::post('/tasks', 'API\TaskController@postNewTask');

    //For teams

    Route::post('/newTeam', 'API\TeamController@postNewTeam');

    Route::get('/loadTeams', 'API\TeamController@loadTeams');

    Route::get('/loadTeam/{id}', 'API\TeamController@loadTeam');

    // For teammember

    Route::post('/addTeamMember', 'API\ManageMembers@createMember');

    Route::get('/loadMembers/{id}', 'API\ManageMembers@loadMembers');

    Route::post('/addNewMember', 'API\ManageMembers@addMember' );


    // For projects

    Route::post('/newProject', 'API\ProjectController@store');

    Route::get('/loadProjects', 'API\ProjectController@index');

    Route::get('loadProjectName/{id}','API\ProjectController@getName' );

    Route::get('/loadProjectsbyTeam/{id}', 'API\ProjectController@getProjects');


    // For new User in Project

    Route::post('/addNewUserInProject', 'API\ProjectUserController@store');

    Route::post('/addTeamToProject', 'API\ProjectUserController@addTeamToProject');


    // For States

    Route::post('/addNewState', 'API\StateController@store');

    Route::get('/loadStates/{id}', 'API\StateController@index');

    Route::delete('/deleteState/{id}','API\StateController@delete');

    // For appointment

    Route::get('/getAppointments','API\AppointmentController@index');

    Route::post('/newAppointment','API\AppointmentController@store');

    // For comments

    Route::get('/loadComments/{id}', 'API\CommentController@index');

    Route::post('/addNewComment', 'API\CommentController@store');


});
