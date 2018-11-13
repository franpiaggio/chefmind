<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model{
    /**
     * Relación con tabla recetas
     */
    public function recipe(){
        return $this->belongsTo('App\Recipe');
    }

    /**
     * Relación con tabla usuario
     */
    public function user(){
        return $this->belongsTo('App\User');
    }
}
