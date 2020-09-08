<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Detail extends Model
{
    public $primaryKey = "id";

    public function feature(){
        return $this->belongsTo(Feature::class, 'feature_id');
    }
}
