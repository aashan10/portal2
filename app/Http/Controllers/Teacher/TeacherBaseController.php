<?php

namespace App\Http\Controllers\Teacher;

use Illuminate\Http\Request;
use App\Http\Controllers\BaseController;

class TeacherBaseController extends BaseController
{
    public function __construct()
    {
        parent::__construct();
        $this->middleware(function($request, $next){
            if($this->user->hasRole('teacher') || $this->user->hasRole('admin')){
                return $next($request);
            }
            return view('errors.unauthorized')->with('message', 'You need to be a Teacher to view this page!');
        });
    }
}
