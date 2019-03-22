<?php

namespace App\Http\Controllers\Moderator;

use Illuminate\Http\Request;
use App\Http\Controllers\BaseController;

class ModeratorBaseController extends BaseController
{
    public function __construct()
    {
        parent::__construct();
        $this->middleware(function($request, $next){
            if($this->user->hasRole('moderator') || $this->user->hasRole('admin')){
                return $next($request);
            }
            return view('errors.unauthorized')->with('message', 'You need to be an Administrator or a  Moderator to view this page!');
        });
    }
}
