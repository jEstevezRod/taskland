<?php

namespace App\Http\Controllers\API;

use App\Models\Team;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use JWTAuth;

class TeamController extends Controller
{
    public function __construct() {
        $this->middleware('auth:api');

    }

    public function loadTeams()
    {
        $user = JWTAuth::user() ;


        $teams = DB::table('teams')
            ->join('team_members', 'teams.id', '=', 'team_members.team_id')
            ->select('teams.t_name','teams.id')
            ->where('team_members.user_id', $user->id)
            ->get();

        return response()->json(['message' => 'Teams loaded correctly!', 'teams' => $teams]);
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
    public function postNewTeam(Request $request)
    {
        $team = new Team;
        $team->t_name = $request->input('t_name');
        $team->save();

        return response()->json([
            'message' => 'Team ' . $request->input('t_name') . ' created correctly',
            'team_id' => $team->id,
            'team' => $team
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Team  $team
     * @return \Illuminate\Http\Response
     */
    public function show(Team $team)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Team  $team
     * @return \Illuminate\Http\Response
     */
    public function edit(Team $team)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Team  $team
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Team $team)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Team  $team
     * @return \Illuminate\Http\Response
     */
    public function destroy(Team $team)
    {
        //
    }
}
