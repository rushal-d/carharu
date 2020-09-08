<?php

namespace App;

use Cviebrock\EloquentSluggable\SluggableScopeHelpers;
use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\SoftDeletes;

class Post extends Model
{
    use SoftDeletes;
    use Sluggable;
    use SluggableScopeHelpers;

    public function sluggable()
    {
        return[
            'slug' => [
                'source' => 'name'
            ]
        ];
    }

    public function getFeaturedImageAttribute($value){
        return asset('uploads/'.$value);
    }

    public function categories()
    {
        return $this->belongsToMany('App\Category', 'post_categories_pivot', 'post_id', 'category_id', 'id', 'id');
    }



}
