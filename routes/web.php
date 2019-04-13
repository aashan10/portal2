<?php
use App\Post;

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
Route::group([ 'middleware' => ['web','welcome','active']],function(){
    Route::get('/home', 'HomeController@index')->name('home');
    Route::resource('/users','UserController');
    Route::post('/post','PostController@store')->name('post.post');


    Route::prefix('/user-meta')->group(function(){
        Route::patch('/update','UserMetaController@update')->name('user-meta.update');
        Route::patch('/update/{id}','UserMetaController@updateCustomMeta')->name('user-meta.updateCustomMeta');
        Route::delete('/delete/{id}','UserMetaController@delete')->name('user-meta.delete');
    });

    Route::prefix('/admin') ->group(function (){

        Route::get('/','Admin/AdminBaseController@index')->name('admin.index');


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
Route::middleware(function($request, $next){
    if(auth()->user()){
        return $next($request);
    }
    return redirect('/login');
})->group(function(){
    Route::get('/user-under-review', 'UserController@userUnderReview')->name('under-review');
    Route::get('/on-boarding','UserController@onBoarding')->name('user.onBoarding');
    Route::patch('/on-boarding','UserMetaController@onBoarding')->name('user.meta.onBoarding');
});


Route::get('post-attachment/{hash}', function($hash){
    $file = Post::where('post_content', $hash)->first();
    
    if($file){
        return response()->file(storage_path('app/public/post_attachments/'.$hash), [
            'Content-Disposition: attachment; filename="'.$file->getMeta('original_name').'.'.$file->getMeta('extension').'"'
        ]);
    }else{
        return redirect(404);
    }
})->name('post-attachment');