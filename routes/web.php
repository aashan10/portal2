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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::resource('/users','UserController');



Route::prefix('/user-meta')->group(function(){
    Route::patch('/update','UserMetaController@update')->name('user-meta.update');
    Route::delete('/delete','UserMetaController@delete')->name('user-meta.delete');
});

Route::post('/user/change-password', 'UserController@changePassword')->name('change-password');