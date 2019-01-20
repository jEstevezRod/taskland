<?php

namespace App\Http\Controllers\API;

use App\Models\Task;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use JWTAuth;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getTasks($id)
    {

        $tasks = Task::where('project_id', $id)->get();

        return response()->json([
            'message' => 'Tasks for project '. $id.' loaded correctly!',
            'tasks' => $tasks
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function postNewTask(Request $request)
    {

        $user = JWTAuth::user();

        $task = new Task;
        $task->author = $user->id;
        $task->project_id = $request->input('project_id');
        $task->subject = $request->input('subject');
        $task->description = $request->input('description');
        $task->state = $request->input('state');

        $task->save();

        return response()->json([
            'message' => 'Task created correctly!',
             'task' => $task
             ]);

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Task $task
     * @return \Illuminate\Http\Response
     */
    public function show(Task $task)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Task $task
     * @return \Illuminate\Http\Response
     */
    public function edit(Task $task)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \App\Models\Task $task
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $task_id = $request->input('data.id');
        $state_name = $request->input('data.state');


        $task = Task::find($task_id);
        $task->state = $state_name;
        $task->save();

        return response()->json([
            'id' => $id,
            'task_updated' => $task,
            'message' => 'Task moved to '. $state_name . ' correctly!']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Task $task
     * @return \Illuminate\Http\Response
     */
    public function destroy(Task $task)
    {
        //
    }
}
