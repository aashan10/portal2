<?php

namespace Modules\Subjects\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Controllers\BaseController;
use Modules\Subjects\Entities\Subject;
use App\Helper\Response;
use Modules\Course\Entities\Course;
class SubjectsController extends BaseController
{
    /**
     * Display a listing of the resource.
     * @return Response
     */

    public function __construct()
    {
        parent::__construct();
        $this->middleware(function($request, $next){
            if($this->user->hasRole('admin')){
                return $next($request);
            }else{
                return view('errors.unauthorized')->with('message', 'You are not allowed to view this page');
            }
        })->except(['index','show','getSubjectsFromCourse']);
        $this->courses = Course::all();
    }
    
    public function index()
    {
        $this->subjects = Subject::all();
        return view('subjects::index',$this->data);
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create()
    {
        return view('subjects::create');
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Response
     */
    public function store(Request $request)
    {
        $subject = new Subject();
        $subject->name = $request->name;
        $subject->sub_code = $request->sub_code;
        $subject->practical_marks = $request->practical_marks;
        $subject->theory_marks = $request->theory_marks;
        $subject->assessment = $request->assessment;
        $subject->credit_hours = $request->credit_hour;
        $subject->Description = $request->description;
        $subject->Syllabus = $request->syllabus;
        $subject->save();
        return redirect()->back();


    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Response
     */
    public function show($id)
    {
        $this->subject = Subject::findOrFail($id);
        return view('subjects::show', $this->data);
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Response
     */
    public function edit($id)
    {
        return view('subjects::edit');
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
        //
    }
    public function getSubjectsFromCourse($id){
        $course = Course::find($id);
        if($course){
            $subjects = $course->subjects();
            if($subjects == []){
                return Response::errorContentNotFound('There are no subjects in this course');
            }
            $returnString = '';
            foreach($subjects as $subject){
                $returnString .= "<option value='".$subject->id."'>".$subject->name."</option>";
            }
            return Response::successWithData('Success', $returnString);

        }else{
            return Response::errorContentNotFound('The selected is either removed or isnt available.');
        }
    }
}
