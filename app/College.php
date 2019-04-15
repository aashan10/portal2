<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\CollegeAdmin;
use App\Course;

class College extends Model
{
    public function __construct()
    {
        parent::__construct();
    }
    public function getName(){
        return $this->name;
    }

    public function getDescription(){
        return $this->description;
    }

    public function getAddress(){
        return $this->address;
    }
    public function getContact(){
        return $this->contact;
    }
    public function getBannerImage(){
        return $this->banner_image;
    }
    public function isCollegeAdmin(User $user){
        return (CollegeAdmin::where('college_id', $this->id)->where('user_id', $user->id)->first()) ? true : false ;
    }

    public function hasCourse(Course $course){
        return (CollegeCourse::where('college_id', $this->id)->where('course_id', $course->id)->first() !== null) ? true : false;
    }

    public function courses(){
        $courses = [];
        foreach(CollegeCourse::where('college_id', $this->id)->get() as $course){
            array_push($courses, Course::find($course));
        }
        return $courses;
    }
}
