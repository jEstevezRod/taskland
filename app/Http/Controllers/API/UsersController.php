<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\User;
use function GuzzleHttp\Promise\all;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Input;
use DB;
use Illuminate\Http\Request;
use Validator;
use JWTFactory;
use JWTAuth;
use Illuminate\Support\Facades\Session;

class UsersController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['getLoginUser','me']]);
    }

    public function getUser($id) {

        $user = User::where('id', $id)->first();

        return response()->json([
            'message' => 'User loaded correctly',
            'user' => $user
        ]);

    }


    public function getLoginUser(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:6',
        ]);

        $credentials = request(['email', 'password']);

        try {
            if (!JWTAuth::attempt($credentials)) {
                return response()->json([
                    'message' => 'invalid_credentials',
                    'data' => null
                ], 401);
            }
        } catch (JWTException $e) {
            return response()->json([
                'message' => 'could_not_create_token',
                'data' => null
            ], 500);
        }

        $user = auth()->user();

        $data['token'] = auth()->claims([
            'user_id' => $user->id,
            'name' => $user->name,
            'email' => $user->email,
        ])->attempt($credentials);

        $data['user'] = $user;

        return response()->json([
            'message' => 'Success',
            'data' => $data
        ])->header('Authorization', $data['token']);

    }

    public function logout()
    {
        auth()->logout();

        return response()->json(['message' => 'Successfully logged out']);
    }

    protected function respondWithToken($token)
    {
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth()->factory()->getTTL() * 60,
            'user_id' => auth()->user()->getId()
        ]);
    }


    public function refresh()
    {
        return $this->respondWithToken(auth()->refresh());
    }

    public function me()
    {   
       
        // $user = auth()->user();

        $user = Auth::user();

        if(isset($user)) 
        {
            $id  = $user->getId();
            return response()->json([
                'message' => 'User logged',
                'user' => $user,
                'id' => $id
                ], 200);
        }
        else {
            return response()->json(['message' => 'User not logged'], 401);
        }
    }

    public function getId()
    {
        return response()->json(auth()->user()->getId());
    }
}
