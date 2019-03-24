<?php

namespace Modules\College\Entities;

use Illuminate\Database\Eloquent\Model;

class College extends Model
{
    public function __construct()
    {
        parent::__construct();
    }
    public function getName(){
        return $this->name;
    }

    public function getDescription(){
        return $this->description;
    }

    public function getAddress(){
        return $this->address;
    }
    public function getContact(){
        return $this->contact;
    }
    public function getBannerImage(){
        return $this->banner_image;
    }
}
