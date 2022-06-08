<?php

namespace App\Http\Controllers;

use App\Role;
use App\User;
use Illuminate\Http\Request;
use App\Http\Resources\UserResource;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Validator;

class UserController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function index(Request $request)
    {

        $user = Auth::user();
        $query = User::query();
        if ($user->hasRole(['admin','super_admin'])) {
            if ($request->has('name')) {
                $query->where('name', 'like', '%' . $request->name . '%');
            }
            if ($request->has('status')) {
                $query->where('active', $request->status);
            }
        return view('cms.user.userindex',['user'=>User::all()]);
        } else {
            $return = ["status" => "error",
                "error" => [
                    "code" => 403,
                    "errors" => 'Forbidden'
                ]];
            return response()->json($return, 403);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('cms.user.usercreate',['role'=>Role::all()]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $user = Auth::user();

        if ($user->hasRole(['admin','super_admin'])) {

            $validation = Validator::make($request->all(), [
                'name' => 'required|min:3',
                'email' => 'required|email|unique:users',
                'password' => 'required|min:6',
                'role_id' => 'required|exists:roles,id'
            ]);
            /*checking if admin role is trying to create super admin role*/
            if(!$user->hasRole('super_admin')){
                $role = Role::find($request->role_id);
                $validation->after(function ($validator)use ($role){
                    if($role->name === 'super_admin'){
                        $validator->errors()->add('role_id','Role not allowed');
                    }
                });
            }

            if ($validation->fails()) {
                return response()->json($validation->errors() , 422);

            }

            $user_input = $request->all();
            $user_input['password'] = bcrypt($user_input['password']);
            $created_user = User::create($user_input);
            $created_user->roles()->attach($request['role_id']);
            return redirect('/user');

        } else {
            $return = ["status" => "error",
                "error" => [
                    "code" => 403,
                    "errors" => 'Forbidden'
                ]];
            return response()->json($return, 403);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return UserResource
     */
    public function show($id)
    {
        $user = Auth::user();

            if ($user->hasRole(['admin','super_admin']) || $user->id == $id) {
            return new  UserResource(User::find($id));
        } else {
            $return = ["status" => "error",
                "error" => [
                    "code" => 403,
                    "errors" => 'Forbidden'
                ]];
            return response()->json($return, 403);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {   $user = Auth::user();
        if ($user->hasRole(['admin','super_admin']) || $user->id == $id) {
            return view('cms.user.useredit',[
                'post'=>User::findOrFail($id)
            ]);
        }else {
            $return = ["status" => "error",
                "error" => [
                    "code" => 403,
                    "errors" => 'Forbidden'
                ]];
            return response()->json($return, 403);
        }

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return UserResource
     */
    public function update(Request $request, $id)
    {
        $user = Auth::user();
        if ($user->hasRole(['admin','super_admin']) || $user->id == $id) {
            $user_update = User::findOrFail($id);
            $validation = Validator::make($request->all(), [
                'name' => 'sometimes|min:3',
                'email' => 'sometimes|email',
                'role_id' => 'sometimes',
                'password'=>['string','required','confirmed']
            ]);
            if ($validation->fails()) {
                return response()->json($validation->errors(),422);

            }
            $user_input = $request->all();
            
            $user_update->name=$request->name;
            $user_update->email=$request->email;
            $user_update->password=bcrypt($request->password);
            $user_update->save();
            
            if ($request['role_id'] != null) {
                $user_update->roles()->sync($request['role_id']);
            }
            
            return back()->with('success','You have successfully schanged your user detail.');
        } else {
            $return = ["status" => "error",
                "error" => [
                    "code" => 403,
                    "errors" => 'Forbidden'
                ]];
            return response()->json($return, 403);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = Auth::user();
        $user_delete = User::findOrFail($id);
        if ($user->hasRole(['admin','super_admin'])) {
            if ($user_delete->token()) {
                $accessToken = $user_delete->token();
                DB::table('oauth_refresh_tokens')
                    ->where('access_token_id', $accessToken->id)
                    ->update(['revoked' => true]);
                $accessToken->revoke();
            }
            $user_delete->delete();
            $return = ["status" => "Success",
                "error" => [
                    "code" => 200,
                    "errors" => 'Deleted'
                ]];
            return redirect('/user');
        } else {
            $return = ["status" => "error",
                "error" => [
                    "code" => 403,
                    "errors" => 'Forbidden'
                ]];
            return response()->json($return, 403);
        }
    }
}
