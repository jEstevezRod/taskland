<?php

namespace App\Http\Controllers\Web;

use App\User;
use Socialite;
use Illuminate\Http\Request;
use function GuzzleHttp\Promise\all;
use App\Http\Controllers\Controller;
use Auth;
use JWTFactory;
use JWTAuth;

class AuthenticationController extends Controller
{

    public function getSocialRedirect($social)
    {
        try {
            return Socialite::with($social)->stateless()->redirect();
        } catch (\InvalidArgumentException $e) {
            return redirect('/#/');
        }
    }

    public function getSocialCallback($social)
    {

        $socialUser = Socialite::with($social)->stateless()->user();

        $user = User::where('provider_id', '=', $socialUser->id)
            ->where('provider', '=', $social)
            ->first();


        if ($user == null) {
            $newUser = new User();

            $newUser->name = $socialUser->getName();
            $newUser->email = $socialUser->getEmail() == '' ? '' : $socialUser->getEmail();
            $newUser->avatar = $socialUser->getAvatar();
            $newUser->password = null;
            $newUser->provider = $social;
            $newUser->provider_id = $socialUser->getId();

            $newUser->save();

            $user = $newUser;
        }
        $token = JWTAuth::fromUser($user) ;

        return redirect('/#/main')->with(['data' => $this->respondWithToken($token)] );

    }
    protected function respondWithToken($token)
    {
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth()->factory()->getTTL() * 60,
//            'user_id' => auth()->user()->getId()
        ]);
    }
}