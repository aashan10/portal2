<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Modules\College\Entities\College;

class CollegeController extends Controller
{
    public function create(Request $request){

    }

    public function show($id){
        $college = College::findOrFail($id);
        return $college;
    }

    public function update(Request $request){

    }

    public function edit($id){
        $college = College::findOrFail($id);
        return $college;
    }

    public function index(){
        $colleges = College::all();
        return $colleges;
    }

    public function destroy($id){
        $college = College::findOrFail($id);
        $college->delete();
        return redirect()->back()->with('success', 'College deleted successfully!');
    }
}
