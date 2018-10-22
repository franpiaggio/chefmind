<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    /**
     * Asocio Recetas y categorias
     */
    public function recipes(){
        return $this->belongsToMany('App\Category')->withTimestamps();
    }
}
