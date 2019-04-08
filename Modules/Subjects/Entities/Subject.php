<?php

namespace Modules\Subjects\Entities;

use Illuminate\Database\Eloquent\Model;
use Modules\Course\Entities\CourseSubject;

class Subject extends Model
{
    public function courses(){
        $courseSubjects = CourseSubject::where('subject_id', $this->id)->get();
        $courses = [];
        foreach($courseSubjects as $courseSubject){
            array_push($courses, $courseSubject->course());
        }
        return $courses;
    }
}
