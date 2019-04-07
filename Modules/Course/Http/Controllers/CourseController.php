<?php

namespace Modules\Course\Http\Controllers;


use Illuminate\Http\Request;
use Illuminate\Http\Response;

use Modules\College\Entities\College;
use Modules\Course\Entities\Course;
use App\Http\Controllers\BaseController;

class CourseController extends BaseController
{
    /**
     * Display a listing of the resource.
     * @return Response
     */

    public function __construct(){
        parent::__construct();
        $this->middleware(function($request, $next){
            if($this->user->hasRole('admin')){
                return $next($request);
            }else{
                return view('errors.unauthorized')->with('message', 'You are not allowed to iew this page!');
            }
        })->except(['show']);
    }
    public function index()
    {
        $this->courses  = Course::all();
        return view('course::index', $this->data);
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create()
    {
        $college = College::all();
        return view('course::create',['colleges' => $college]);
        //
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Response
     */
    public function show($id)
    {
        $this->course = Course::findOrFail($id);
        return view('course::show', $this->data);
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Response
     */
    public function edit($id)
    {
        return view('course::edit');
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Response
     */
    public function destroy($id)
    {
        $course = Course::findOrFail($id);
        if(Auth::user()->hasPermissionTo('delete_course')){
            $course->delete();
            return redirect()->back()->with('success', 'The course was deleted successfully!');
        }else{
            return redirect()->back()->with('error', 'You do not have permission for this operation!');
        }
    }

    public function store(Request $request)
    {
        $request->validate([
            'courseName' => 'string|required',
            'totalYears' => 'numeric|required',
            'university' => 'string|required'
        ]);

        $course = new Course();
        $course->title = $request->courseName;
        $course->total_years = $request->totalYears;
        $course->is_semester_based = $request->is_semester_based;
        if($request->total_semesters){
            $course->total_semesters = $request->total_semesters;
        }

        $course->university = $request->university;
        $course->description = $request->description;
        $course->save();

        return redirect()->back()->with('success', 'Course Successfully Added');
    }
}
