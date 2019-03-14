<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Auth;
use Illuminate\Support\Facades\Hash;
use App\Helper\Response;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        parent::__construct();
    }
    public function index()
    {
        $users = User::paginate(100);
        return view('users.list')->with('users', $users);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        if(Auth::user() !== null){
            if(Auth::user()->hasPermissionTo('create_user')){
                return view('users.create');
            }
            return redirect()->back()->with('error','You don\'t have permission to create a new user!');
        }else{
            return redirect('/register');
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if(Auth::user()){
            if( Auth::user()->hasPermissionTo('create_user')){
                return redirect()->back()->with('success', 'The user was created!');
            }
            return redirect()->back()->with('error', 'You don\'t have permission to create a new user!');
        }else{
            return redirect('/register');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        return view('users.show', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        if(Auth::user()){
            if(Auth::user()->hasPermissionTo('edit_user') || Auth::user()->id == $user->id){
                return view('users.edit')->with('user', $user);
            }
            return redirect()->back()->with('error','You don\'t have permission to edit this user!');
        }
        return redirect('/login')->with('error','You need to log in first!');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        if(Auth::user()->hasPermissionTo('edit_user') || Auth::user()->id == $user->id){
            $request->validate([
                'name' => 'required|string|min:2',
                'email' => 'required|email'
            ]);
            $user->name = $request->input('name');
            $user->email = $request->input('email');
            $user->save();
            return redirect()->back()->with('success','The account was updated!');
        }
        return redirect()->back()->with('error','You don\'t have permissions for this action!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     * @throws \Exception
     */
    public function destroy(User $user)
    {
        if(Auth::user()->hasPermissionTo('delete_user')){
            $user->delete();
            return redirect()->back()->with('success','The user account was deleted!');
        }
        abort(401);
        //
    }

    public function changePassword(Request $request){
        $user = Auth::user();

        $request->validate([
            'current_password' => 'string|min:6|max:40',
            'password' => 'required|string|min:6|max:40|confirmed',
            'password_confirmation' => 'required|string|same:password',
        ]);
        if($user->password !== null){
            if(Hash::check($request->input('current_password'), $user->password)){
                $user->password = bcrypt($request->input('password'));
                $user->save();
                return redirect()->back()->with('success', 'Password changed successfully!');
            }
            return redirect()->back()->with('error','The password you entered is not correct!');
        }else{
            $user->password = bcrypt($request->input('password'));
            $user->save();
            return redirect()->back()->with('success', 'Password changed successfully!');
        }
    }
    public function changeAvatar(Request $request){
        if($request->file('avatar')){
            $user = Auth::user();
            $filename = md5(microtime().$user->email).'.'.$request->file('avatar')->extension();
            $request->file('avatar')->storeAs('public/profile_pictures', $filename);
            $user->avatar = $filename;
            $user->save();
            return Response::success('Profile Picture updated successfully!');
        }
        return Response::errorUnprocessibleEntity('Please select an image file to upload!');
    }
    public function userUnderReview(){
        if(Auth::user()->status == 'active'){
            return redirect('/home');
        }
        return view('users.pending');
    }
}
