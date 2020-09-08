<?php

namespace App;

use Cviebrock\EloquentSluggable\Sluggable;
use Cviebrock\EloquentSluggable\SluggableScopeHelpers;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Brand extends Model
{
    use SoftDeletes;
    use Sluggable;
    use SluggableScopeHelpers;

    public function sluggable()
    {
        return[
            'slug' => [
                'source' => 'brand_name'
            ]
        ];
    }
    public $table = "brands";
    public $primaryKey = "brand_id";

    public function models()
    {
        return $this->hasMany(Modell::class, 'brand_id', 'brand_id');
    }

    public function getPermalinkAttribute(){
        return route('cars').'/'.$this->slug;
    }

    public function getFeaturedImageAttribute(){
        return !empty($this->brand_image) ? asset('uploads').'/'.$this->brand_image : '';
    }
}
