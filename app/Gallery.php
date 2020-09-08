<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Config;

class Gallery extends Model
{
    public function scopeInterior($query){
        return $query->where('category', Config::get('constants.image_category_interior'));
    }

    public function scopeExterior($query){
        return $query->where('category', Config::get('constants.image_category_exterior'));
    }

    public function scopeOther($query){
        return $query->where('category', Config::get('constants.image_category_other'));
    }

    public function scopeColor($query){
        return $query->where('category', Config::get('constants.image_category_color'));
    }

    public function getFullImageAttribute(){
        return asset("uploads/{$this->image}");
    }
}
