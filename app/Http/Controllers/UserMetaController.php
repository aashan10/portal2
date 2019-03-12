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
                }else{
                    $meta = $user->setMeta($key, $value);
                }
            }
            $meta->save();
        }
        return redirect()->back()->with('success','The user meta was updated successfully!');
    }

    public function updateCustomMeta($id, Request $request){
        $request->validate([
            'key' => 'string|required',
            'value' => 'nullable|string',
            'type' => 'in:url,text,number,tel,date,time,email',
            'icon' => 'nullable|string'
        ]);
        $customMeta = UserMeta::findOrFail($id);
        $customMeta->key = $request->key;
        $customMeta->value = $request->value;
        $customMeta->type = $request->type;
        $customMeta->icon = $request->icon;
        $customMeta->save();
        return redirect()->back()->with('success', 'The custom field was updated successfully!');
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
