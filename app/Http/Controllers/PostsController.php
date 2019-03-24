<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Helper\Response;
use App\Post;
class PostsController extends Controller
{
    public function createFromTitle(Request $request, Post $post){
        $post->post_title = $request->title;
        $post->user_id = auth()->id();
        $post->post_status = 'draft';
        $post->save();
        return Response::successWithData('Post drafted', [
            'update_url' => route('post.update', $post->id)
        ]);
    }

    public function show($id){
        return $id;
    }

    public function update(Request $request, $id){
        $request = $request->except(['_token', '_method']);
        $post = Post::findOrFail($id);
        $post->post_status = 'published';
        $post->update($request);
        return Response::successWithData('Post published', $post);
    }

    public function storeComment(Request $request, Post $post, $id){
        $post->post_content = $request->comment_status;
        $post->post_type = 'comment';
        $post->post_status = 'published';
        $post->user_id = auth()->id();
        $post->parent_id = $id;
        $post->save();
        return Response::successWithData('Comment Published',$post->id);
    }
    public function upvote($post){
        $post = Post::findOrFail($post);
        if($this->hasVoted($post) !== false){
            $vote = $this->hasVoted($post);
            $vote->type = 'upvote';
            $vote->save();
        }else{
            $vote = new Vote();
            $vote->user_id = auth()->id();
            $vote->post_id = $post->id;
            $vote->type = 'upvote';
            $vote->save();
        }
        return Response::successWithData('Upvoted', $vote);
    }
    public function hasVoted($post){
        $vote = Vote::where('user_id', auth()->id()->where('post_id', $post)->first());
        return ( $vote ) ? $vote : false;
    }
    public function downvote($post){
        if($this->hasVoted($post) !== false){
            $vote = $this->hasVoted($post);
            $vote->type = 'downvote';
            $vote->save();
        }else{
            $vote = new Vote();
            $vote->user_id = auth()->id();
            $vote->post_id = $post->id;
            $vote->type = 'downvote';
            $vote->save();
        }
        return Response::successWithData('Upvoted', $vote);
    }
}
