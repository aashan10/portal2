<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Auth;
use App\User;
use App\Post;
class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
        $this->middleware('auth');
        
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        if(Auth::user()->hasRole('admin')){
            $this->pendingUsers = count(User::where('status','')->get());
            $this->totalStudents = count(User::role('student')->get());
            $this->activeStudents = count(User::role('student')->where('status','active')->get());
            $this->pendingStudents = count(User::role('student')->where('status','pending')->get());
            $this->suspendedStudents = count(User::role('student')->where('status','suspended')->get());
            $this->totalStaffs = count(User::role('staff')->get());
            $this->activeStaffs = count(User::role('staff')->where('status','active')->get());
            $this->suspendedStaffs = count(User::role('staff')->where('status','suspended')->get());
            $this->pendingStaffs = count(User::role('staff')->where('status','pending')->get());
        }
        $this->posts = Post::posts();
        $this->postsCount = count($this->user->posts());
        $this->filesCount = count($this->user->files());
        // $this->comments = Post::comments(1);
        return view('home', $this->data);
    }
}
