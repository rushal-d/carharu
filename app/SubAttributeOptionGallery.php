<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SubAttributeOptionGallery extends Model
{
    use SoftDeletes;
    protected $table = 'subattribute_option_gallery';

    public function attribute()
    {
        return $this->belongsTo(SubAttributeOptionModel::class, 'subattribute_option_id', 'id');
    }

    public function image()
    {
        return $this->belongsTo(Gallery::class, 'gallery_id', 'id');
    }
}
