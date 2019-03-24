<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Post;
use App\User;
class Vote extends Model
{

    public function post(){
        return $this->belongsTo(Post::class)->first();
    }

    public function user(){
        return $this->belongsTo(User::class)->first();
    }


}
