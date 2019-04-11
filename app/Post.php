<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Post extends Model
{
    use SoftDeletes;

    protected $dates =['deleted_at'];

    protected $fillable = [ 'post_title', 'post_content', 'user_id' ];
    
    public function user(){
        return $this->belongsTo('App\User')->first();
    }

    public function vote(){
        return $this->hasMany('App\Vote');
    }

    public function meta(){
        return $this->hasMany('App\PostMeta')->get();
    }

    public function getMeta($meta = null){
        if($meta == null){
            return $this->meta();
        }else{
            $meta = $this->hasMany('App\PostMeta')->where('key', $meta)->first(); 
            if($meta !== null){
                return $meta->value;
            }
            return null;
        }
    }

    public function setMeta($key, $value){
        $meta = $this->hasMany('App\PostMeta')->where('key', $key)->first();
        if($meta !== null){
            $meta->value = $value;  
        }else{
            $meta = new PostMeta();
            $meta->post_id = $this->id;
            $meta->key = $key;
            $meta->value = $value;
        }
        $meta->save();
        return true;
    }

    public function attachments(){
        return $this->hasMany('App\Post', 'parent_id', 'id')->where('post_type','attachment')->get();
    }

    public static function posts(){
        return static::where('post_type', 'post')->orderBy('created_at','desc')->get();
    }
    public function hasAttachments(){
        return (count($this->attachments()) > 0) ? true : false;
    }

    public function src(){
        if($this->post_type == 'attachment'){
            return asset('storage/profile_pictures/'.$this->getMeta('src'));
        }
        return null;
    }
    public function isImage(){
        $mime_type = $this->post_mime_type;
        $image_mime_types = [
            'image/png',
            'image/jpg',
            'image/bmp',
            'image/jpeg',
            'image/svg+xml',
            'image/gif',
            'image/x-icon',
            'image/x-rgb'
        ];
        if(in_array($mime_type, $image_mime_types)){
            return true;
        }
        return false;
    }
    public function getExtension(){
        $src = $this->getMeta('src');
        if($src == null){
            return null;
        }
        $extension = explode('.',$src);
        return $extension[1];
    }
    public function getVotes(){
        return $this->hasMany('App\Vote', 'post_id', 'id')->get();
    }
    public function upvotes(){
        return $this->hasMany('App\Vote', 'post_id', 'id')->where('type', 'upvote')->get();
    }
    public function downvotes(){
        return $this->hasMany('App\Vote', 'post_id', 'id')->where('type', 'downvote')->get();
    }
    public function getVoteCount(){
        return count($this->getVotes());
    }

    public function comments(){
        return $this->where('post_type', 'comment')->where('parent_id',$this->id)->get();
    }
    public function countVotes(){
        return count($this->upvotes()) - count($this->downvotes());
    }
}
