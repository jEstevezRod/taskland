<?php

namespace App\Http\Controllers\API;

use App\Models\Project;
use App\Models\ProjectUser;
use App\Models\State;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use JWTAuth;

class ProjectController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth:api');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = JWTAuth::user();

        $projects = DB::table('project_users')
            ->join('users', 'project_users.user_id', '=', 'users.id')
            ->join('projects', 'projects.id', '=', 'project_users.project_id')
            ->select('projects.p_name', 'projects.id')
            ->where('users.id', '=', $user->id)
            ->get();


        $states_array = [];

        if (count($projects) <= 0) {
            $name = str_replace(' ', '-', $user->name);
            $default_project = $name . '-project';
            $project = new Project();
            $project->p_name = $default_project;
            $project->team_id = null;
            $project->description = "Default project added automatically by Taskland.";
            $project->save();

            $userInProject = new ProjectUser();
            $userInProject->user_id = $user->id;
            $userInProject->project_id = $project->id;
            $userInProject->save();

            $states_to_return = [];
            $default_states = ['queue', 'in progress', 'completed'];

            foreach ($default_states as $state_default) {
                $state = new State();
                $state->name = $state_default;
                $state->author = $user->id;
                $state->project = $project->id;
                $state->save();
                array_push($states_to_return, $state);
            }

            return response()->json(['projects' => array($project), 'states' => $states_to_return]);
        }

        return response()->json(['projects' => $projects, 'states' => $states_array]);


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
    public function store(Request $request)
    {

        $project = Project::create([
            "p_name" => $request->input('name'),
            "team_id" => $request->input('team') ? $request->input('team') : null,
            "description" => $request->input('description') ? $request->input('description') : null
        ]);

        return response()->json(['message' => 'Project created correctly', 'project' => $project]);


    }


    public function loadChart($id)
    {
        $user_id = $id;
        $main_data = [];
        $tasks = [];

        $projects = DB::table('project_users')
            ->join('projects', 'project_users.project_id','projects.id')
            ->select('project_users.project_id','projects.p_name')
            ->where('project_users.user_id', $user_id)
            ->get();

        foreach ($projects as $project)
        {
            $result = DB::table('tasks')
                ->select('tasks.*')
                ->where('tasks.project_id', $project->project_id)
                ->count();
            array_push($tasks,$result);
        }

        foreach ($projects as $project)
        {
            $main_data[] = $project->p_name;
        }

        return response()->json(['labels' => $main_data, 'data' => $tasks]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Project $project
     * @return \Illuminate\Http\Response
     */
    public function show(Project $project)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Project $project
     * @return \Illuminate\Http\Response
     */
    public function edit(Project $project)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \App\Models\Project $project
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Project $project)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Project $project
     * @return \Illuminate\Http\Response
     */
    public function destroy(Project $project)
    {
        //
    }

    public function getName($id)
    {
        $project = Project::where('id', $id)->first();

        return response()->json([
            'message' => 'Name loaded correctly',
            'name' => $project->p_name,
            'project' => $project
        ]);

    }

    public function getProjects($id)
    {

        $projects = Project::where('team_id', $id)->get();

        return response()->json([
            'message' => 'Projects for team ' . $id . ' loaded correctly',
            'projects' => $projects
        ]);
    }


}
