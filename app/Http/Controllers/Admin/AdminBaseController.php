<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\BaseController;
use App\User;
use App\Post;
class AdminBaseController extends BaseController
{
    public function __construct()
    {
        parent::__construct();
        $this->middleware(function($request, $next){
            if($this->user->hasRole('admin')){
                $this->pendingUsers = count(User::where('status','')->get());
                $this->totalStudents = count(User::role('student')->get());
                $this->activeStudents = count(User::role('student')->where('status','active')->get());
                $this->pendingStudents = count(User::role('student')->where('status','pending')->get());
                $this->suspendedStudents = count(User::role('student')->where('status','suspended')->get());
                $this->totalStaffs = count(User::role('staff')->get());
                $this->activeStaffs = count(User::role('staff')->where('status','active')->get());
                $this->suspendedStaffs = count(User::role('staff')->where('status','suspended')->get());
                $this->pendingStaffs = count(User::role('staff')->where('status','pending')->get());
                $this->posts = Post::posts();
                $this->postsCount = count($this->user->posts());
                $this->filesCount = count($this->user->files());
                if($this->user->hasRole('student')){

                }
    
                if($this->user->hasRole('college admin')){
    
                }
    
                if($this->user->hasRole('teacher')){
                
                }
    
                if($this->user->hasRole('moderator')){
                    
                }

                if($this->user->hasRole('student')){

                }

                return $next($request);

            }
            return view('errors.unauthorized')->with('message', 'You need to be an Administrator to view this page!');
        });
    }
}
