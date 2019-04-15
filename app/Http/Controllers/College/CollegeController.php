<?php

namespace App\Http\Controllers\College;

use App\College;
use Illuminate\Http\Request;
use App\Http\Controllers\ResourceController;

class CollegeController extends ResourceController{
    public function __construct(Request $request){
        parent::__construct(College::class, $request);
    }
    public function index(){
        return success('These are the colleges.', [
            'colleges' => $this->data,
        ]);
    }
}