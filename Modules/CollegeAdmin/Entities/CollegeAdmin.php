<?php

namespace Modules\CollegeAdmin\Entities;

use Illuminate\Database\Eloquent\Model;

class CollegeAdmin extends Model
{
    public function admin(){
        return $this->belongsTo('App\User')->first();
    }
}
