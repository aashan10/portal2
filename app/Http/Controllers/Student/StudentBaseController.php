<?php

namespace App\Http\Controllers\Student;

use Illuminate\Http\Request;
use App\Http\Controllers\BaseController;

class StudentBaseController extends BaseController
{
    public function __construct()
    {
        parent::__construct();
        $this->middleware(function($request, $next){
            if($this->user->hasRole('admin') || $this->user->hasRole('teacher') || $this->user->hasRole('student') || $this->user->hasRole('moderator') || $this->user->hasRole('college admin')){
                return $next($request);
            }
            return view('errors.unauthorized')->with('message', 'You need to be a Student to view this page!');
        });
    }
}
