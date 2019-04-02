<?php

namespace Modules\Course\Http\Controllers;

use App\Http\Controllers\Admin\AdminBaseController;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\College\Entities\College;
use Modules\Course\Entities\Course;

class CourseController extends AdminBaseController
{
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        return view('course::index');
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
        return view('course::show');
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
        //
    }

    public function store(Request $request)
    {
        $request->validate([
            'courseName' => 'string|required',
            'college_id' => 'numeric|required',
            'description' => 'string|required'
        ]);

        $course = new Course();
        $course->college_id = $request->college_id;
        $course->name = $request->courseName;
        $course->description = $request->description;
        $course->save();

        return redirect()->back()->with('success', 'Course Successfully Added');
    }
}
