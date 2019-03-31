<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
class BaseController extends Controller
{
    public $data = [];
    
    public function __construct(){
        $this->middleware(function($request, $next){
            $this->user = Auth::user();
            return $next($request);
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
