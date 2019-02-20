<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Support\Facades\Hash;


class RegisterController extends Controller
{
    public function __construct()
    {
        $this->middleware('guest');
    }

    public function register(Request $request)
    {
        $name=$request->input('name');
        $lastname= $request->input('lastname');
        $user = User::create([
            'name' => $name,
            'lastname' => $lastname ,
            'alias' => strtolower($name . $lastname),
            'email' => $request->input('email'),
            'password' => Hash::make($request->input('password'))
        ]);

        return response()->json(['message' => 'User created correctly', 'user_data' => $user], 201);

        return $this->respondWithToken(auth()->login($user));

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
}
