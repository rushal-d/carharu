<?php

namespace App;

use Cviebrock\EloquentSluggable\Sluggable;
use Cviebrock\EloquentSluggable\SluggableScopeHelpers;
use Illuminate\Database\Eloquent\Model;

class Sub_Division extends Model
{
    use Sluggable;
    use SluggableScopeHelpers;

    public $table = "sub_divisions";

    public function sluggable()
    {
        return[
          'slug' => [
              'source' => 'name'
          ]
        ];
    }

    public function division(){
        return $this->belongsTo('App\Division', 'division_id', 'id');
    }

    public function scopeTransmission($query){
        return $query->whereHas('division', function($query){
            $query->where('division_id', $this->getDivisionIDBySlug('transmission'));
        });
    }

    public function scopeFuel($query){
        return $query->whereHas('division', function($query){
            $query->where('division_id', $this->getDivisionIDBySlug('fuel'));
        });
    }

    public function getDivisionIDBySlug($slug){
        return \App\Division::findBySlug($slug)->id;
    }

}
