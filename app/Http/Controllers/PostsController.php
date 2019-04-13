<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Helper\Response;
use App\Post;
use App\Vote;
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
        
    }

    public function update(Request $request, $id){
        
        
        $updates = $request->except(['_token', '_method']);
        $post = Post::findOrFail($id);
        $post->subject_id = $request->subject;
        $post->course_id = $request->course;
        $post->post_type = 'post';
        $post->post_status = 'published';
        if($request->file('attachments')){
            foreach($request->file('attachments') as $file){
                $filename = sha1((md5(microtime().$file->getClientOriginalName()))).'.'.$file->getClientOriginalExtension();
                
                $file->storeAs('public/post_attachments', $filename);

                $attachment = new Post();
                $attachment->post_title = null;
                $attachment->post_content = $filename;
                $attachment->post_type = 'attachment';
                $attachment->parent_id = $post->id;
                $attachment->post_mime_type = $file->getClientMimeType();
                $attachment->user_id = auth()->id();
                $attachment->save();
                $attachment->setMeta('extension', $file->getClientOriginalExtension());
                $attachment->setMeta('original_name', $file->getClientOriginalName());
            }
        }
        $post->update($updates);

        return redirect()->back()->with('success', 'The post was created successfully!');
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
        if($post->countVotes() > 1000000000){
            $votes = (int) ($post->countVotes() / 1000000000);
            $votes .= 'B';
        }else if($post->countVotes() > 1000000){
            $votes = (int) ($post->countVotes() / 1000000);
            $votes .= 'M';
        }else if($post->countVotes() > 1000){
            $votes = (int) ($post->countVotes() / 1000000);
            $votes .= 'K';
        }else{
            $votes = $post->countVotes();
        }

        return Response::successWithData('Upvoted', [
            'votes_count' => $votes,
            'type' => 'upvote'
        ]);
    }
    public function hasVoted(Post $post){
        $vote = Vote::where('user_id', auth()->id())->where('post_id', $post->id)->first();
        return ( $vote ) ? $vote : false;
    }
    public function downvote($post){
        $post = Post::findOrFail($post);
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
        if($post->countVotes() > 1000000000){
            $votes = (int) ($post->countVotes() / 1000000000);
            $votes .= 'B';
        }else if($post->countVotes() > 1000000){
            $votes = (int) ($post->countVotes() / 1000000);
            $votes .= 'M';
        }else if($post->countVotes() > 1000){
            $votes = (int) ($post->countVotes() / 1000000);
            $votes .= 'K';
        }else{
            $votes = $post->countVotes();
        }
        return Response::successWithData('Downvoted', [
            'votes_count' => $votes,
            'type' => 'downvote'
        ]);
    }
}
