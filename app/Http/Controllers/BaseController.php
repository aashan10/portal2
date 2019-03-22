<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BaseController extends Controller
{
    protected $data = [];
    
    public function __construct(){
        $this->middleware(function($request, $next){
            $this->user = Auth::user();
        });
    }

    public function __get($name)
    {
        return $this->data[$name];
    }

    public function __set($name, $value)
    {
        $this->data[$name] = $value;
    }

}
