<?php

namespace Modules\CollegeAdmin\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\CollegeAdmin\CollegeAdminBaseController;
use Modules\College\Entities\College;
use Modules\CollegeAdmin\Entities\CollegeAdmin;

class CollegeAdminController extends CollegeAdminBaseController
{
    /**
     * CollegeAdminController constructor.
     */
    public function __construct(College $college)
    {
        $this->college = College::all();
    }


    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        $collegeAdmin = new CollegeAdmin();
        $id = auth()->user()->id;
        if($collegeAdmin->isCollegeAdmin($id)){
            $this->pendingStudent = User::role('student')->where('status','pending')->get();
            return view('collegeadmin::index',$this->data);
        }
       return redirect()->back();
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create()
    {
        return view('collegeadmin::create');
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Response
     */
    public function show($id)
    {
        return view('collegeadmin::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Response
     */
    public function edit($id)
    {
        return view('collegeadmin::edit');
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


    public function approve($id)
    {
        $user = User::findorFail($id);
        $user->status = 'active';
        $user->save();
        return 'Student Approved';
    }
    public function suspend($id)
    {
        $user = User::findorFail($id);
        $user->status = 'suspended';
        $user->save();
        return 'Student Suspended';

    }
}
