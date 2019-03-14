<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    public function user(){
        return $this->belongsTo('App\User')->first();
    }

    public function meta(){
        return $this->hasMany('App\PostMeta')->get();
    }

    public function attachments(){
        return $this->hasMany('App\Post', 'parent_id', 'id')->where('type','attachment')->get();
    }

    public static function posts(){
        return static::where('type', 'post')->get();
    }
}
