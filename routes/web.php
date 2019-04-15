<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/
$router->get('/', function(){
    return app()->version();
});

$router->post('/register', [
    'uses' => 'UserController@register',
    'as' => 'user.register'
]);

$router->post('/login', [
    'uses' => 'UserController@login',
    'as' => 'user.login'
]);

$router->group([
    'middleware' => 'auth'
], function () use ($router) {
    $router->get('/user-data',[
        'uses' => 'UserController@user',
        'as' => 'user.user-data'
    ]);
    $router->get('/user-meta',[
        'uses' => 'UserController@getMeta',
        'as' => 'user.user-meta'
    ]);
    $router->get('/colleges',[
        'uses' => 'College\CollegeController@index',
        'as' => 'college.get'
    ]);
});


$router->group([
    'prefix' => '/admin',
    'middleware' => 'auth',
    'as' => 'admin.',
], function() use ($router){
    $router->get('/', [
        'uses' => 'Admin\AdminController@index'
    ]);
});