<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Auth;
use App\User;
use App\Post;
use Modules\CollegeAdmin\Entities\CollegeAdmin;
use Modules\College\Entities\College;
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
        if(Auth::user()->hasRole('college admin')){
            $colleges = CollegeAdmin::where('user_id', $this->user->id)->get();
            $clz = [];
            foreach($colleges as $college){
                array_push($clz,$college->college_id);
            }
            $this->my_pending_students = User::whereIn('college_id',$clz)->where('status','pending')->get();
        }
        $this->posts = Post::posts();
        $this->postsCount = count($this->user->posts());
        $this->filesCount = count($this->user->files());
        return view('home', $this->data);
    }
}
