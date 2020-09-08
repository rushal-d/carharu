<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Attribute_Model extends Model
{
    public $table = "attribute_models";

    public function sub_attribute(){
        return $this->belongsTo(Sub_Attribute::class, 'sub_attribute_id');
    }
}
