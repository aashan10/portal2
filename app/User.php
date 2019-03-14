<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use Notifiable;
    use HasRoles;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password','status','avatar','provider',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token', 'provider_token','provider_refresh_token'
    ];

    public function meta(){
        return $this->hasMany('App\UserMeta','user_id','id');
    }

    public function metaExists(string $meta){
        if($this->meta()->where('key',$meta)->first() !== null){
            return true;
        }
        return false;
    }

    public function setMeta(string $key, $value = null){
        if($this->metaExists($key)){
            $meta = $this->meta()->where('key',$key)->first();
            $meta->value = $value;
        }else{
            $meta = new UserMeta();
            if(($key == 'facebook')){
                $meta->type = 'url';
                $meta->icon = 'fa fa-facebook';
            }elseif($key == 'twitter'){
                $meta->type = 'url';
                $meta->icon = 'fa fa-twitter';
            }elseif($key == 'website'){
                $meta->type = 'url';
                $meta->icon = 'fa fa-globe';
            }
            $meta->user_id = $this->id;
            $meta->key = $key;
            $meta->value = $value;
            $meta->save();
        }
        return $meta;
    }

    public function getMeta($key = null){
        if(!$key){
            $exclude = [];
            $except = $this->getLinks();
            $meta = $this->getMeta('bio');
            array_push($exclude, ($meta!= null) ? $meta->id : null);
            foreach($except as $e){
                if($e->key != 'bio'){
                    array_push($exclude,$e->id);
                }
            }
        }
        return ($key == null) ? $this->meta()->get()->except($exclude) : $this->meta()->where('key',$key)->first();
    }

    public function getLinks(){
        return $this->meta()->where('icon', '!=', null)->whereIn('type', ['url','email'])->get();
    }
    public function getDefaultMetaIds(){
        $defaultMeta = $this->meta()
            ->where('key','bio')
            ->orWhere('key','facebook')
            ->orWhere('key','twitter')
            ->orWhere('key','phone')
            ->orWhere('key','faculty')
            ->orWhere('key','batch')
            ->orWhere('key','website')->get();
        $ids = [];
        foreach($defaultMeta as $meta){
            array_push($ids,$meta->id);
        }
        return $ids;
    }
    public function hasCustomMeta(){
        $ids = $this->getDefaultMetaIds();
        if($this->meta()->get()->except($ids) !== null){
            return true;
        }
        return false;
    }

    public function getCustomMeta(){
        $ids = $this->getDefaultMetaIds();
        $metas = $this->meta()->get()->except($ids);
        return $metas;
    }

    public function getAvatarUrl(){
        if($this->avatar == null){
            $this->avatar = 'https://avatars.dicebear.com/v2/avataaars/'.md5(microtime().$this->email).'.svg';
        }
        return $this->avatar;
    }

    public function posts(){
        return $this->hasMany('App\Post')->where('type','post')->get();
    }

    public function files(){
        return $this->hasMany('App\Post')->where('type','attachment')->get();
    }
}
