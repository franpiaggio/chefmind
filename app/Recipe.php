<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Recipe extends Model{

    /**
     * Datos que se pueden completar
     */
    protected $fillable = [
      'title', 'body', 'published_at' 
    ];

    /**
     * Relación con tabla usuarios
     */
    public function user(){
      return $this->belongsTo('App\User');
    }
}
