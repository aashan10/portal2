<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    public function subjects(){
        $courseSubjects = $this->hasMany(CourseSubject::class)->get();
        $subjects = [];
        foreach($courseSubjects as $courseSubject){
            array_push($subjects, $courseSubject->subject());
        }
        return $subjects;
    }
}
