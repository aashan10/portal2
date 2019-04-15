<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\CourseSubject;

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
