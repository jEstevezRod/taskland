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

class UsersController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['getLoginUser']]);
    }

    public function getUserCheckPass()
    {

        $pass =  auth()->user()->checkPassword();

        return response()->json(['hasPassword' => $pass], 201);
    }


    public function postFirstPassword(Request $request)
    {
//        return response(['data' => Auth::check()]);

       $user =  auth()->user();

        $user->password = Hash::make($request->input('password'));
        $user->save();

        return response()->json(['password_updated' => true], 201);
    }



    public function getLoginUser(Request $request)
    {

        $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:6',
        ]);

        $credentials = request(['email', 'password']);

        if (!$token = auth()->attempt($credentials)) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }


        return $this->respondWithToken($token);

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
        return response()->json(auth()->user());
    }

}
