<?php

namespace App\Http\Controllers\API;

use App\Models\AssignedTask;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use Tymon\JWTAuth\Facades\JWTAuth;

class AssignedTaskController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function assignTasks(Request $request)
    {
        $array_users = $request->all();
        $userLogged = JWTAuth::user();
        $user_id = $userLogged->id;

        if ($array_users['team_id'] != null) {
            foreach ($array_users['selected'] as $user) {
                $assigned = new AssignedTask;
                $assigned->user_id = $user;
                $assigned->task_id = $request->input('task_id');
                $assigned->project_id = $request->input('project_id');
                $assigned->team_id = $request->input('team_id.id');
                $assigned->save();
            }
        } else {

                $assigned = new AssignedTask;
                $assigned->user_id = $user_id;
                $assigned->task_id = $request->input('task_id');
                $assigned->project_id = $request->input('project_id');
                $assigned->team_id = null;
                $assigned->save();
        }

        return response()->json(['message' => 'Task assigned!']);
    }

    public function loadAssignedUsersTask($id)
    {
        $task_id = $id;

        $users = DB::table('assigned_tasks')
            ->join('users','assigned_tasks.user_id','=','users.id')
            ->select('users.name')
            ->where('assigned_tasks.task_id',$task_id)
            ->get();

        return response()->json($users);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\AssignedTask  $assignedTask
     * @return \Illuminate\Http\Response
     */
    public function show(AssignedTask $assignedTask)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\AssignedTask  $assignedTask
     * @return \Illuminate\Http\Response
     */
    public function edit(AssignedTask $assignedTask)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\AssignedTask  $assignedTask
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, AssignedTask $assignedTask)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\AssignedTask  $assignedTask
     * @return \Illuminate\Http\Response
     */
    public function destroy(AssignedTask $assignedTask)
    {
        //
    }
}
