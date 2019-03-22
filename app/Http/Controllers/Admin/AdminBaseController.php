<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\BaseController;

class AdminBaseController extends BaseController
{
    public function __construct()
    {
        parent::__construct();
        $this->middleware(function($request, $next){
            if($this->user->hasRole('admin')){
                return $next($request);
            }
            return view('errors.unauthorized')->with('message', 'You need to be an Administrator to view this page!');
        });
    }
}
