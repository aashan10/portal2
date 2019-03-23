<?php

namespace Modules\Course\Traits;
use Modules\Course\Entities\Course;

trait HasCourse{
    public function courses(){
        return $this->hasMany(Course::class);
    }
}