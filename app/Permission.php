<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Zizaco\Entrust\EntrustPermission;
use Nicolaslopezj\Searchable\SearchableTrait;


class Permission extends EntrustPermission
{
    use SearchableTrait;

    /**
     * Searchable rules.
     *
     * @var array
     */
    protected $searchable = [
        /**
         * Columns and their priority in search results.
         * Columns with higher values are more important.
         * Columns with equal values have equal importance.
         *
         * @var array
         */
        'columns' => [
            'name' => 10
        ]
    ];


    protected $fillable = [
        'name',
        'display_name',
        'description',
        'parent_id',
        'order',
        'icon',
        'isURL',
    ];

    public function scopeRootPermission($query)
    {
        return $query->where('parent_id', 0)->orderBy('order', 'asc');
    }

    public function scopeNextLevel($query, $id)
    {
        return $query->where('parent_id', $id)->orderBy('order', 'asc');
    }

    public function childPs()
    {
        return $this->hasMany('\App\Permission', 'parent_id', 'id');
    }

    public function scopeRootMenu($query)
    {
        return $query->where('parent_id', 0)->orderBy('order', 'asc');
    }

    public function roles()
    {
        return $this->belongsToMany('\App\Role', 'permission_role', 'permission_id', 'role_id');
    }

    public function parents()
    {
        return $this->hasOne('\App\Permission', 'id', 'parent_id');
    }
}
