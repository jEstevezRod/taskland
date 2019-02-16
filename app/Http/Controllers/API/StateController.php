<?php

namespace App\Http\Controllers\API;

use App\Models\Comment;
use App\Models\State;
use App\Models\Task;
use function GuzzleHttp\Promise\all;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use JWTAuth;
use DB;

class StateController extends Controller
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
    public function index( $id )
    {

        $own_states = State::where('project','=', $id)->get();

        return response()->json([
            'message' => 'States for project with id '. $id .' loaded correctly!',
            'states' => $own_states]);
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
    public function store(Request $request)
    {

        $user = JWTAuth::parseToken()->authenticate();

        $state = State::create([
            'name' => $request->input('data.name'),
            'project' => $request->input('data.project'),
            'author' => $user->id
        ]);


        return response()->json([
            'message' => 'State created correctly!',
            'state' => $state]);

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\State  $state
     * @return \Illuminate\Http\Response
     */
    public function show(State $state)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\State  $state
     * @return \Illuminate\Http\Response
     */
    public function edit(State $state)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\State  $state
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
//
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\State  $state
     * @return \Illuminate\Http\Response
     */
    public function delete($id, Request $request)
    {

        $comments = DB::table('comments')
            ->join('tasks', 'comments.task_id', '=', 'tasks.id')
            ->select('comments.*')
            ->where('project_id', $request->input('project'))
            ->where('state', $request->input('name'))
            ->delete();

        $state = State::where('id',$id)->delete();

        $tasks = Task::where('project_id', $request->input('project'))
        ->where('state', $request->input('name'))->delete();

        if ($tasks == 1) $message = 'State and tasks removed correctly!';
        else $message = 'State removed correctly!';

        return response()->json(['state' => $id, '' => $tasks,
            'message' => $message]);
    }
}
