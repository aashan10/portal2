<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Scopes\UserMetaNullValueExcludeScope;
class UserMeta extends Model
{
    protected $table = 'user_meta';
    public static function boot(){
        parent::boot();
        static::addGlobalScope(new UserMetaNullValueExcludeScope());
    }
}
