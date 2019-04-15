<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Firebase\JWT\JWT;
use Firebase\JWT\ExpiredException;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;

class UserController extends Controller{
    public function register(Request $request){
        $this->validate($request, [
            'username' => 'required|string|unique:users|min:3|max:10',
            'email' => 'required|email|unique:users',
            'password' => 'required|string|min:8|max:40',
            'name' => 'required|string|min:2'
        ]);
        
        $user = new User();
        $user->username = $request->username;
        $user->password = app('hash')->make($request->password);
        $user->name = $request->name;
        $user->email = $request->email;
        $user->save();
        return $user;
    }
    protected function token(User $user){
        $payload = [
            'iss' => "portal-user-api-token", 
            'sub' => $user->id, 
            'iat' => time(), 
            'exp' => time() + 60*60
        ];
        return JWT::encode($payload, env('API_AUTH_KEY'));

    }
    public function login(Request $request){
        $this->validate($request, [
            'email' => 'required|string',
            'password' => 'required|string'
        ]);
        $user = User::where('email', $request->email)->first();
        if(!$user){
            return response()->json([
                'status' => 'error',
                'message' => 'The email \'{$request->email}\' doesn\'t exist!'
            ], 404);
        }else{
            if(app('hash')->check($request->password, $user->password)){
                return response()->json([
                    'status' => 'success',
                    'message' => 'Logged in successfully!',
                    'data' => [
                        'token' => $this->token($user),
                        'user' => $user
                    ]
                ],200);
            }else{
                return response()->json([
                    'status' => 'error',
                    'message' => 'The username and password don\'t match!'
                ], 401);
            }
        }
        
    }
    public function user(Request $request){
        $model_roles = DB::table('model_has_roles')->where('model_id', $request->auth->id)->where('model_type', 'App\User')->get();
        $user_roles = [];
        foreach($model_roles as $roles){
            $role = Role::find($roles->role_id);
            if($role !== null){
                array_push($user_roles, [
                    'id' => $role->id,
                    'name' => $role->name,
                    'guard' => $role->guard_name
                ]);
            }
        }
        $request->auth->avatar = $request->auth->getAvatarUrl();
        return success('User data fetched successfully!',[
                'user' => $request->auth,
                'role' => [
                    'length' => count($user_roles),
                    'roles' => $user_roles
                ]
        ]);
    }
    public function getMeta(Request $request){
        return $request->auth->getMeta();
    }
}