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

    Route::post('/logoutUser', 'API\UsersController@logout');

    Route::get('/user/{id}','API\UsersController@getUser');

    Route::get('userId','API\UsersController@getId');

    //For tasks

    Route::get('/loadTasks/{id}', 'API\TaskController@getTasks');

    Route::post('/changeStatus/{id}', 'API\TaskController@update');

    Route::get('/countTasks', 'API\TaskController@countTasks' );

    Route::get('/loadTask/{id}', 'API\TaskController@loadTask');

    Route::get('/loadUsersInProject/{id}', 'API\TaskController@loadUsersInProject');

    /*Route::get('/tasks/{id}', 'API\TaskController@getTask'); */

    Route::post('/tasks', 'API\TaskController@postNewTask');

    //For teams

    Route::post('/newTeam', 'API\TeamController@postNewTeam');

    Route::get('/loadTeams', 'API\TeamController@loadTeams');

    Route::get('/loadTeam/{id}', 'API\TeamController@loadTeam');

    Route::get('/loadTeamWithProject/{id}', 'API\TeamController@loadTeamWithProject');

    // For teammember

    Route::post('/addTeamMember', 'API\ManageMembers@createMember');

    Route::get('/loadMembers/{id}', 'API\ManageMembers@loadMembers');

    Route::post('/addNewMember', 'API\ManageMembers@addMember' );

    Route::get('/loadTeamMembersWithProject/{id}', 'API\ManageMembers@loadTeamMembersWithProject');


    // For projects

    Route::post('/newProject', 'API\ProjectController@store');

    Route::get('/loadProjects', 'API\ProjectController@index');

    Route::get('loadProjectName/{id}','API\ProjectController@getName' );

    Route::get('/loadProjectsbyTeam/{id}', 'API\ProjectController@getProjects');

    Route::get('loadChartData/{id}', 'API\ProjectController@loadChart');

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

    Route::get('/loadTasksCalendar', 'API\AppointmentController@loadTasksCalendar');

    // For comments

    Route::get('/loadComments/{id}', 'API\CommentController@index');

    Route::post('/addNewComment', 'API\CommentController@store');

    // For assign assign Tasks

    Route::post('/assignTaskTo', 'API\AssignedTaskController@assignTasks');

    Route::get('/loadAssignedUsersTask/{id}', 'API\AssignedTaskController@loadAssignedUsersTask');

    // For notes

    Route::get('/indexNotes', 'API\NoteController@index');

    Route::post('/storeNotes', 'API\NoteController@store');

    Route::put('/updateNote/{id}', 'API\NoteController@update');

    Route::delete('/deleteNote/{id}' , 'API\NoteController@destroy');

    // For files

    Route::post('/uploadPicture', 'API\FileController@store');

    // For Messages

     Route::get('/contacts', 'API\ContactsController@getContacts');
     
     Route::get('/messages/{id}', 'API\ContactsController@getMessages');

     Route::post('/sendMessage', 'API\ContactsController@sendMessage');

});
