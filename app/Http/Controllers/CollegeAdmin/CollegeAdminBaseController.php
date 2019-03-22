<?php

namespace App\Http\Controllers\CollegeAdmin;

use Illuminate\Http\Request;
use App\Http\Controllers\BaseController;

class CollegeAdminBaseController extends BaseController
{
    public function __construct()
    {
        parent::__construct();
        $this->middleware(function($request, $next){
            if($this->user->hasRole('college admin')){
                return $next($request);
            }
            return view('errors.unauthorized')->with('message', 'You need to be a College Administrator to view this page!');
        });
    }
}
