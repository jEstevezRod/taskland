<?php

namespace App\Http\Controllers\API;

use App\Models\TeamMember;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use JWTAuth;

class ManageMembers extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api');
    }

    public function createMember(Request $request)
    {


        $user = JWTAuth::user() ;

        $teammember = TeamMember::create([
            'team_id' => $request->input('team_id'),
            'user_id' => $user->id
        ]);


        return response()->json(['message' => 'Teammember created correctly',
            'Team member' => $teammember
        ]);

    }

    public function loadMembers($id) {

        $members = TeamMember::select('team_members.*')
        ->where('team_members.team_id', $id)
        ->get();

        return response()->json([
            'message' => 'Members loaded correctly!',
            'members' => $members
        ]);

    }

    public function addMember (Request $request)
    {
        //const
        //status: 0 -failed
        //status: 1 - success

        //parameters
        
        $email = $request->input('email');
        $team_id = $request->input('team');

        //check if user exist

        $user = User::where('email', '=', $email)->first();

        if ($user === null) return response()->json(['message' => 'User not exists!', 'status' => 0]);

        //check if user is already in the team

        $user_in_team = TeamMember::where('team_id', $team_id)->where('user_id', $user->getId())->first();

        if ($user_in_team !== null) return response()->json(['message' => 'User already is your team!','status' => 0]);

        //add to the team 

        $member = new TeamMember;
        $member->team_id = $team_id;
        $member->user_id = $user->getId();
        $member->save();

        return [ 'message' => "Member added correctly!", 'member' => $member, 'status' => 1];
    }
}
