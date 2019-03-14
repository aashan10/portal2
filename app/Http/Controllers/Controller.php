<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\Auth;
class Controller extends BaseController
{
    public $data = [];
    public function __construct()
    {
        $this->middleware(function($request, $next){
            $this->user = Auth::user();
            return $next($request);
        });
    }
    public function __set($name, $value)
    {
        $this->data[$name] = $value;
    }

    public function __get($name)
    {
        if (array_key_exists($name, $this->data)) {
            return $this->data[$name];
        }
        return null;
    }
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
}
