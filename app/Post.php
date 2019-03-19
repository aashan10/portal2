<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    public function user(){
        return $this->belongsTo('App\User')->first();
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

    public function attachments(){
        return $this->hasMany('App\Post', 'parent_id', 'id')->where('post_type','attachment')->get();
    }

    public static function posts(){
        return static::where('post_type', 'post')->get();
    }
    public function hasAttachments(){
        return (count($this->attachments()) > 0) ? true : false;
    }

    public function src(){
        if($this->type == 'attachment'){
            return asset('storage/profile_pictures/'.$this->getMeta('src'));
        }
        return null;
    }
    public function isImage(){
        $mime_type = $this->getMeta('mime_type');
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
}
