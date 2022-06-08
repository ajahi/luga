<?php
/**
 * Created by PhpStorm.
 * User: santosh
 * Date: 1/6/18
 * Time: 8:49 AM
 */

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Role;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Laravel\Passport\Client;


use App\Http\Resources\UserResource as UserResource;

class LoginController extends Controller
{

    use IssueTokenTrait;
    private $client;

    public function __construct()
    {
        $this->client = Client::find(2);
    }

    public function login(Request $request)
    {

        $this->validate($request, [
            'email' => 'required|string|email',
            'password' => 'required|string'
        ]);


        $credentials = request(['email', 'password']);
//        $credentials['deleted_at'] = null;
//        $credentials['active'] = "active";

        if (!Auth::attempt($credentials)) {
            return response()->json([
                'message' => 'Detail does not match',
            ], 403);
        }

        $user = $request->user();
//        if ($user->active === "inactive") {
//            return response()->json([
//                new UserResource($user)
//            ], 403);
//        } elseif ($user->activation_token !== "") {
//            $user->notify(new SignupActivate($user));
//            return response()->json([
//                new UserResource($user)
//            ], 403);
//        }


        $tokenResult = $user->createToken('Personal Access Token');
        $token = $tokenResult->token;

//        if ($request->remember_me)
        $token->expires_at = Carbon::now()->addWeeks(1);

        $token->save();
    return redirect('/admin');
        return response()->json([
            'id' => $user->id,
            'access_token' => $tokenResult->accessToken,
            'token_type' => 'Bearer',
            'expires_at' => $tokenResult->token->expires_at

        ]);
    }

    public function user()
    {
        return new UserResource(Auth::user());
    }


    public function refresh(Request $request)
    {
        $this->validate($request, [
            'refresh_token' => 'required'
        ]);
        return $this->issueToken($request, 'refresh_token');
    }


    public function logout()
    {
        $accessToken = Auth::user()->token();
        DB::table('oauth_refresh_tokens')
            ->where('access_token_id', $accessToken->id)
            ->update(['revoked' => true]);
        $accessToken->revoke();
        return response()->json([], 204);
    }


//    public function social(Request $request)
//    {
//        $userData['name'] = $request->name;
//        $userData['email'] = $request->email;
//        $userData['password'] = str_random(10);
//        $userData['active'] = "inactive";
//        $userData['provider_name'] = $request->provider_name;
//        $userData['provider_id'] = $request->provider_id;
//        $userData['activation_token'] = "";
//
//        $user = User::where('provider_name',$request->provider_name)->where('provider_id',$request->provider_id)->first();
//        if(!$user){
//            if(!User::where('email',$request->email)->first()){
//                $user = new User($userData);
//
//                $user->save();
//                $role = Role::where('name','customer')->first();
//                $user->roles()->attach($role->id);
//
//                if(Config::get('auth.authentication') == "loose"){
//                    $user->active = "active";
//                    $user->save();
//                }elseif (Config::get('auth.authentication') == "code"){
//                    $user->active = "active";
//                    $user->save();
//                }
//            }else{
//                return response()->json([
//                    'message' => 'Email already registered',
//                ], 403);
//            }
//        }
//        if ($user->active === "inactive") {
//            return response()->json([
//                new UserResource($user)
//            ], 403);
//        }
//        $tokenResult = $user->createToken('Personal Access Token');
//        $token = $tokenResult->token;
//
////        if ($request->remember_me)
//        $token->expires_at = Carbon::now()->addWeeks(1);
//
//        $token->save();
//
//        return response()->json([
//            'id' => $user->id,
//            'access_token' => $tokenResult->accessToken,
//            'token_type' => 'Bearer',
//            'expires_at' => $tokenResult->token->expires_at
//
//        ]);
//
//    }

}
