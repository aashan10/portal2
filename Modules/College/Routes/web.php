<?php

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

Route::prefix('/admin')->name('admin.')->middleware('auth')->middleware(function($request, $next){
    if(auth()->user()->hasRole('admin')){
        return $next($request);
    }
    return view('errors.unauthorized')->with('message','You are not authorized to view this page!');
})->group(function(){
    Route::resource('/college','CollegeController');
});