<?php

namespace App\Http\Controllers\API;

use App\Models\Project;
use App\Models\Task;
use App\Models\ProjectUser;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use JWTAuth;
use DB;
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

    public function loadTask ($id)
    {
        $task = Task::where('id', $id)->first();

        $project = Task::join('projects','tasks.project_id','=','projects.id')
            ->select('projects.p_name')
            ->where('tasks.id', $id)
            ->get();

        return response()->json([
            'message' => 'Task loaded correctly',
            'task' => $task,
            'project'=> $project
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
        $task->dueDate = $request->input('due_date');
        $task->progress = $request->input('progress');

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

    public function countTasks() {


        $user = JWTAuth::user() ;


        $projects_array = ProjectUser::where('user_id', '=', $user->id)
            ->join('projects', 'projects.id', '=', 'project_users.project_id')
            ->select('projects.id','projects.team_id', 'projects.p_name')->get();
        $task_number = 0;
        $null_project = 0;
        $team_project = 0;

        foreach ($projects_array as $value) {
            $task_number = Task::where('project_id', '=', $value->id)->count() + $task_number;
        }
        foreach ($projects_array as $value) {
            if ($value->team_id == null) {
                $null_project++;
            } else {
                $team_project++;
            }
        }

        return response()->json([
            'a' => $task_number,
            'b' => $team_project,
            'c' => $null_project,
            'd' => count($projects_array)
        ]);



    }



    public function loadUsersInProject($id)
    {
        $project_id = $id;
        $assignable = false;

        $query = DB::table('projects')
            ->join('teams','projects.team_id','=','teams.id')
            ->join('team_members','teams.id','=','team_members.team_id')
            ->join('users','team_members.user_id','=','users.id')
            ->select('users.id','users.name')
            ->where('projects.id', $project_id)
            ->get();

        $check_team = Project::where('id',$project_id)->first();

        if ($check_team->team_id === null)
        {
            $assignable = false;
            return response()->json([
               'assignable' => $assignable
            ]);
        } else {
            $assignable = true;

            $query = DB::table('projects')
            ->join('teams','projects.team_id','=','teams.id')
            ->join('team_members','teams.id','=','team_members.team_id')
            ->join('users','team_members.user_id','=','users.id')
            ->select('users.id','users.name')
            ->where('projects.id', $project_id)
            ->get();

            return response()->json([
                'assignable' => $assignable,
                'results'=> $query
            ]);
        }


    }
}
