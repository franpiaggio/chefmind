<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Image extends Model{
    /**
     * Relación con tabla recetas
     */
    public function recipe(){
        return $this->belongsTo('App\Recipe');
    }
}
