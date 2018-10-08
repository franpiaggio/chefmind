<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    /**
     * Relation with User table
     */
    public function users(){
        return $this
            ->belongsToMany('App\User')
            ->withTimestamps();
    }
}
