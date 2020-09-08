<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Feature extends Model
{
    public function spec()
    {
        return $this->belongsTo(Specification::class, 'specs_id');
    }

    public function detail()
    {
        return $this->hasMany(Detail::class, 'feature_id', 'id');
    }
}
