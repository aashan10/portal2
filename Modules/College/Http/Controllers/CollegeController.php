<?php

namespace Modules\College\Http\Controllers;

use Illuminate\Http\Request;
use Modules\College\Entities\College;
use App\Http\Controllers\Admin\AdminBaseController;

class CollegeController extends AdminBaseController
{
    public function create(){
        return view('college::create', $this->data);
    }

    public function store(Request $request){
        $request->validate([
            'title' => 'string|required',
            'address' => 'string|required',
            'contact' => 'string|required',
            'email' => 'email|required',
            'banner' => 'file|required',
            'description' => 'string|required'
        ]);

        $college = new College();
        $college->title = $request->title;
        $college->address = $request->address;
        $college->contact = $request->contact;
        $college->email = $request->email;
        if($request->hasFile('banner')){
            $filename =  bcrypt($request->file('banner')->getClientOriginalName().microtime()).$request->file('banner')->getClientOriginalExtension();
            $request->file('banner')->storeAs('public/college_banners/',$filename);
            $college->banner = $filename;
        }
        $college->description = $request->description;
        $college->save();
        return redirect()->back()->with('success', 'College added successfully!');
    }

    public function show($id){
        $college = College::findOrFail($id);
        return $college;
    }

    public function update(Request $request){

    }

    public function edit($id){
        $this->college = College::findOrFail($id);
        return view('college::create', $this->data);
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
