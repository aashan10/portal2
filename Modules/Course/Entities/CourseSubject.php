<?php

namespace Modules\Course\Entities;

use Illuminate\Database\Eloquent\Model;
use Modules\Subjects\Entities\Subject;

class CourseSubject extends Model
{
    public function course(){
        return $this->belongsTo(Course::class)->first();
    }
    public function subject(){
        return $this->belongsTo(Subject::class)->first();
    }
}
