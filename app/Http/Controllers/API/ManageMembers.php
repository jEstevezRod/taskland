<?php

namespace App\Http\Controllers\API;

use App\Models\TeamMember;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use JWTAuth;

class ManageMembers extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api');
    }

    public function new(Request $request)
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

}
