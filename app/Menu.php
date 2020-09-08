<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    protected $table="menus";
    protected $fillable=[
        'id',
        'menu_name',
        'parameters',
        'route',
        'display_name',
        'parent_id',
        'order',
        'icon',
    ];

    public function childs()
    {
        return $this->hasMany('App\Menu', 'parent_id', 'id');
    }

    public function parents()
    {
        return $this->hasOne('App\Menu', 'id', 'parent_id');
    }

    public function childPs()
    {
        return $this->hasMany('\App\Menu', 'parent_id', 'id');
    }

    public function scopeRootMenu($query)
    {
        return $query->where('parent_id', 0)->orderBy('order', 'asc');
    }

    public function scopeNextLevel($query, $id)
    {
        return $query->where('parent_id', $id)->orderBy('order', 'asc');
    }
}
