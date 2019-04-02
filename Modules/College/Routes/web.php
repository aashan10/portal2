<?php

use Modules\College\Entities\College;
use App\Helper\Response;
use Modules\College\Entities\CollegeCourse;
use Modules\Course\Entities\Course;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::prefix('/admin')->name('admin.')->middleware(function($request, $next){
    if(auth()->user()->hasRole('admin')){
        return $next($request);
    }
    return view('errors.unauthorized')->with('message','You are not authorized to view this page!');
})->group(function(){
    Route::resource('/college','CollegeController');
});

Route::get('/college/get-courses/{id}', function($id){
    $college = College::find($id);
    if($college == null){
        return Response::errorContentNotFound('The requested college was not found or hasn\'t yet been affiliated to '. env('APP_NAME').'!');
    }
    $data = [
        'status' => 'success',
        'courses' => [

        ]
    ];
    foreach(CollegeCourse::where('college_id', $college->id)->get() as $course){

        if(Course::find($course->course_id)){
            array_push($data['courses'], Course::find( $course->course_id));
        }
    }
    return Response::successWithData('Courses fetched successfully!',$data);

})->name('college.getcourses');