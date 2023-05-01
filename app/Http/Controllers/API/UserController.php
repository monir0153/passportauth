<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function UserLogin(Request $request)
    {
        $input = $request->all();

        Auth::attempt($input);
        $user = Auth::user();

        $token = $user->createToken('example')->accessToken;
        return response(['status' => 200, 'token' => $token],200);

    }

    /**
     * Store a newly created resource in storage.
     */
    public function GetUser()
    {
        if(Auth::guard('api')->check()){
            $user = Auth::guard('api')->user();
            return response(['data' => $user],200);

        }
        return response(['error' => 'Unauthorized'],401);

    }

    /**
     * Display the specified resource.
     */
    public function UserLogout()
    {
        if(Auth::guard('api')->check()){

            $accessToken = Auth::guard('api')->user()->token();
            \DB::table('oauth_refresh_tokens')->where('access_token_id', $accessToken->id)
            ->update(['revoked' => true]);
            $accessToken->revoke();

            return response(['data' => 'Unauthorized','message' => 'user logout'],200);
        }
        return response(['error' => 'Unauthorized'],401);

    }


}
