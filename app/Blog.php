<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
    protected $table = "blogs";

    protected $fillable = [
        'model_id',
        'title',
        'description',
        'blog_cover',
    ];

    public function model()
    {
        return $this->belongsTo(Modell::class, 'model_id', 'model_id');
    }
}
