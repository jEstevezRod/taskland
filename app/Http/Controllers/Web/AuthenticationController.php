<?php

namespace App\Http\Controllers\Web;

use App\User;
use Illuminate\Support\Facades\Cookie;
use Socialite;
use Illuminate\Http\Request;
use function GuzzleHttp\Promise\all;
use App\Http\Controllers\Controller;
use Auth;
use JWTFactory;
use JWTAuth;
use Response;
use Session;
use Hash;

class AuthenticationController extends Controller
{

    public function getSocialRedirect($social)
    {
        try {
            return Socialite::with($social)->stateless()->redirect();
        } catch (\InvalidArgumentException $e) {
            return redirect('/#/');
        }


//        return [
//            'url' => Socialite::driver($social)->stateless()->redirect()->getTargetUrl(),
//        ];

    }

    public function getSocialCallback($social)
    {

        $socialUser = Socialite::with($social)->stateless()->user();

        $user = User::where('provider_id', $socialUser->id)
            ->where('provider', $social)
            ->first();


        if ($user == null) {

            $newUser = new User;
            $newUser->name = $socialUser->getName();
            $newUser->email = $socialUser->getEmail() == '' ? '' : $socialUser->getEmail();
            $newUser->avatar = $socialUser->getAvatar();
            $newUser->password = $socialUser->getId();
            $newUser->provider = $social;
            $newUser->provider_id = $socialUser->getId();

            $newUser->save();

            $user = $newUser;

        }


        if (! $token = auth()->login($user)) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }


        return redirect('/#/password', 301, [
            'Authorization' => 'Bearer ' . $token
        ]);

//        return redirect('/#/password')->with([respondWithToken($token)]);

    }

    protected function respondWithToken($token)
    {
        return response()->json([
            'token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth()->factory()->getTTL() * 60,
        ]);
    }

    public function loadUserWithoutPass(Request $request)
    {
        $token  = $request->input('token');

        $user = JWTAuth::toUser($token);

        return response()->json(['user' => $user]);
    }
}