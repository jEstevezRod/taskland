<?php

namespace App\Http\Controllers\API;

use App\Models\ProjectUser;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use JWTAuth;

class ProjectUserController extends Controller
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
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $user = JWTAuth::parseToken()->authenticate();

        $project_id = $request->input('data.id');

        if (isset($project_id)) {

            $newUserInProject = ProjectUser::create([
                'user_id' => $user->id,
                'project_id' => $project_id
            ]);

        }

        return response()->json([
            'message' => 'New User with id '. $user->id.' added to a Project with id '.$newUserInProject->project_id .' correctly',
            'userInProject' => $newUserInProject
        ], 201);


    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ProjectUser $projectUser
     * @return \Illuminate\Http\Response
     */
    public function show(ProjectUser $projectUser)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ProjectUser $projectUser
     * @return \Illuminate\Http\Response
     */
    public function edit(ProjectUser $projectUser)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \App\Models\ProjectUser $projectUser
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ProjectUser $projectUser)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ProjectUser $projectUser
     * @return \Illuminate\Http\Response
     */
    public function destroy(ProjectUser $projectUser)
    {
        //
    }
}
