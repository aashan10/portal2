<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Subject;

class CourseSubject extends Model
{
    public function course(){
        return $this->belongsTo(Course::class)->first();
    }
    public function subject(){
        return $this->belongsTo(Subject::class)->first();
    }
}
