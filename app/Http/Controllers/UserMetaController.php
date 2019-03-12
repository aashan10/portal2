<?php

namespace App\Http\Controllers;

use App\User;
use App\UserMeta;
use Illuminate\Http\Request;
use Auth;
use App\Helper\Response;
class UserMetaController extends Controller
{
    public function __construct()
    {
    }

    public function store(Request $request, User $user = null)
    {
        ($user == null) ? $user =  Auth::user() : null ;
        dd($request->all());
        foreach($request->all() as $key =>  $value){
            $meta = $user->setMeta($key, $value);
            $meta->type = in_array($value['type'], ['text','number','email','tel','url','date','time']) ? $value['type'] : 'text';
            $meta->icon = $value['icon'];
            $meta->save();
        }
        return redirect()->back()->with('success','The user meta was saved successfully!');
    }

    public function update(Request $request, User $user = null)
    {
        ($user == null) ? $user = Auth::user() : '' ;
        $metas = $request->except(['_token','_method']);
        foreach ($metas as $key => $value){
            if($key !== null && $value !== null){
                if(is_array($value)){
                    $meta = $user->setMeta($key, $value['value']);
                    $meta->type = in_array($value['type'], ['text','number','email','tel','url','date','time']) ? $value['type'] : 'text';
                    $meta->icon = $value['icon'];
                    $meta->save();
                }else{
                    $user->setMeta($key, $value);
                }
            }
        }
        return redirect()->back()->with('success','The user meta was updated successfully!');
    }

    public function delete($key )
    {
        $meta = UserMeta::find($key);
        if($meta){
            $key = $meta->key;
            $meta->delete();
            return Response::success('The '.$key.' field has been deleted successfully!');
        }
        return Response::errorContentNotFound();
    }
}
