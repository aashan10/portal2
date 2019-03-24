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


Route::group([ 'middleware' => ['web','active']],function(){
    Auth::routes();
    Route::get('/home', 'HomeController@index')->name('home');
    Route::resource('/users','UserController');
    Route::post('/post','PostController@store')->name('post.post');


    Route::prefix('/user-meta')->group(function(){
        Route::patch('/update','UserMetaController@update')->name('user-meta.update');
        Route::patch('/update/{id}','UserMetaController@updateCustomMeta')->name('user-meta.updateCustomMeta');
        Route::delete('/delete/{id}','UserMetaController@delete')->name('user-meta.delete');
    });

    Route::prefix('/admin') ->group(function (){

        Route::get('/','AdminController@index')->name('admin.index');


    });
    Route::post('/user/change-password', 'UserController@changePassword')->name('change-password');
    Route::post('/user/change-avatar', 'UserController@changeAvatar')->name('change-avatar');

    Route::resource('/post', 'PostsController');
    Route::prefix('/post')->name('post.')->group(function(){
        Route::post('/create-from-title', 'PostsController@createFromTitle')->name('createFromTitle');
        Route::post('/post_comment/{post_id}','PostsController@storeComment')->name('comment');
        Route::post('/{id}/upvote','PostsController@upvote')->name('upvote');
        Route::post('/{id}/downvote','PostsController@downvote')->name('downvote');
    });
    
});
Route::get('/user-under-review', 'UserController@userUnderReview')->name('under-review');
