<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sub_Attribute extends Model
{
    public $table = "sub_attributes";

    public function attribute(){
        return $this->belongsTo(Attribute::class, 'attribute_id');
    }
}
