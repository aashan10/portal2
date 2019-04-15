<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PostMeta extends Model
{
    public function post(){
        return $this->belongsTo('App\Post')->first();
    }
}
