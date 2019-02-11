<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Auth;
class UserMetaController extends Controller
{
    public function __construct()
    {
    }

    public function store(Request $request, User $user = null)
    {
        ($user == null) ? $user =  Auth::user() : null ;
        foreach($request->all() as $key =>  $value){
            $user->setMeta($key, $value);
        }
        return redirect()->back()->with('success','The user meta was saved successfully!');
    }

    public function update(Request $request, User $user = null)
    {
        ($user == null) ? $user = Auth::user() : '' ;
        $metas = $request->except(['_token','_method']);
        foreach ($metas as $key => $value){
            if($key !== null && $value !== null){
                $user->setMeta($key, $value);
            }
        }
        return redirect()->back()->with('success','The user meta was updated successfully!');
    }

    public function destroy(User $user, $key )
    {
        $usermeta = $user->meta()->where('key',$key)->first();
        $usermeta->delete();
        return redirect()->back()->with('success','The `{$key}` was deleted successfully!');
    }
}
