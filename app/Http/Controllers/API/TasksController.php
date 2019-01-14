<?php

namespace App\Http\Controllers\API;

use App\Models\Task;
use App\Http\Controllers\Controller;
use Request;

class TasksController extends Controller
{
  /*
  |-------------------------------------------------------------------------------
  | Get All Tasks
  |-------------------------------------------------------------------------------
  | URL:            /api/v1/tasks
  | Controller:     API\TasksController@getTasks
  | Method:         GET
  | Description:    Gets all of the tasks in the application
  */
    public function getTasks(){

        $tasks = Task::all();

        return response()->json( $tasks );

  }

  /*
  |-------------------------------------------------------------------------------
  | Get An Individual Task
  |-------------------------------------------------------------------------------
  | URL:            /api/v1/tasks/{id}
  | Controller:     API\TasksController@getTask
  | Method:         GET
  | Description:    Gets an individual task
  */
  public function getTask( $id ){

    $task = Task::where('id', '=', $id)->first();

    return response()->json( $task );   

  }

  /*
  |-------------------------------------------------------------------------------
  | Adds a New Task
  |-------------------------------------------------------------------------------
  | URL:            /api/v1/tasks
  | Controller:     API\TasksController@postNewTask
  | Method:         POST
  | Description:    Adds a new task to the application
  */
  public function postNewTask(){

    $task = new Task();

    $task->name     = Request::get('name');
    $task->address  = Request::get('address');
    $task->city     = Request::get('city');
    $task->state    = Request::get('state');
    $task->zip      = Request::get('zip');

    $task->save();

    return response()->json($task, 201);

  }
}