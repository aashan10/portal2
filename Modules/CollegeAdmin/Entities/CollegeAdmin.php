<?php

namespace Modules\CollegeAdmin\Entities;

use Illuminate\Database\Eloquent\Model;
use Modules\College\Entities\College;
use App\User;
class CollegeAdmin extends Model
{
    public function admin(){
        return $this->belongsTo(User::class)->first();
    }

    public function college(){
        return $this->belongsTo(College::class)->first();
    }
}
