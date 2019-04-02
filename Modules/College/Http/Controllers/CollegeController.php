<?php

namespace Modules\College\Http\Controllers;

use Illuminate\Http\Request;
use Modules\College\Entities\College;
use App\Http\Controllers\Admin\AdminBaseController;
use Illuminate\Support\Facades\Auth;

class CollegeController extends AdminBaseController
{
    public function __construct()
    {   
        parent::__construct();
        $this->middleware(function($request, $next){
            if(Auth::user() && (Auth::user()->hasRole('admin') || Auth::user()->hasRole('college admin') ) ){
                return $next($request);
            }
            return view('unauthorized')->with('message', 'You are not allowed to view this page!');
        });
    }
    public function create(){
        return view('college::create', $this->data);
    }

    public function store(Request $request){
        $request->validate([
            'title' => 'string|required',
            'address' => 'string|required',
            'contact' => 'string|required',
            'email' => 'email|required',
            'banner' => 'nullable|sometimes|file|mimes:jpg,jpeg,png,gif,bmp',
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

    public function update(Request $request, $id){
        $college = College::findOrFail($id);
        if(!$college->isCollegeAdmin(Auth::user())){
            return view('unauthorized')->with('message','You are not the admin of this college!');
        }
        $request->validate([
            'title' => 'string|required',
            'address' => 'string|required',
            'contact' => 'string|required',
            'email' => 'email|required',
            'banner' => 'nullable|sometimes|file|mimes:jpg,jpeg,png,gif,bmp',
            'description' => 'string|required'
        ]);
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
