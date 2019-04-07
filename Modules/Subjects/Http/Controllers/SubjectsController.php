<?php

namespace Modules\Subjects\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\BaseController;
use Modules\Subjects\Entities\Subject;

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
        })->except(['index','show']);
    }
    
    public function index()
    {
        return view('subjects::index');
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
        //
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
}
