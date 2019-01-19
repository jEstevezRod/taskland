<?php

namespace App\Http\Controllers;

use App\Models\TeamMember;
use Illuminate\Http\Request;
use Validator;
use JWTFactory;
use JWTAuth;

class TeamMemberController extends Controller
{

    public function __construct(){
        $this->middleware('auth:api');
    }

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
    public function new(Request $request)
    {
        $user = JWTAuth::toUser($request->input('token'));

        $teammember = new TeamMember;
        $teammember->team_id = $request->input('team_id');
        $teammember->user_id = $user->id;
        $teammember->save();

        return response()->json(['message' => 'Teammember created correctly',
            'Team member' => $teammember
        ]);

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\TeamMember $teamMember
     * @return \Illuminate\Http\Response
     */
    public function show(TeamMember $teamMember)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\TeamMember $teamMember
     * @return \Illuminate\Http\Response
     */
    public function edit(TeamMember $teamMember)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \App\TeamMember $teamMember
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, TeamMember $teamMember)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\TeamMember $teamMember
     * @return \Illuminate\Http\Response
     */
    public function destroy(TeamMember $teamMember)
    {
        //
    }
}
