<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserState extends Model
{
    /**
     * Relación con tabla de recetas
     */
    public function users(){
        return $this->hasMany('App\User');
    }
}
