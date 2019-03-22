<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Helper\Response;
use App\Post;
class PostsController extends Controller
{
    public function createFromTitle(Request $request){
        return Response::successWithData('Post drafted', ['post' => Post::find(rand(0,count(Post::all())))]);
    }
}
