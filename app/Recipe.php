<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Recipe extends Model{

    /**
     * Datos que se pueden completar
     */
    protected $fillable = [
      'title', 'body', 'published_at', 'featured_image', 'time', 'difficulty'
    ];

    /**
     * Relación con tabla usuarios
     */
    public function user(){
      return $this->belongsTo('App\User');
    }

    /**
     * Relación de categorias con recetas
     */
    public function categories(){
      return $this->belongsToMany('App\Category')->withTimestamps();;
    }

    /**
     * Relación de ingredientes con recetas
     */
    public function ingredients(){
      return $this->belongsToMany('App\Ingredient')->withTimestamps();;
    }
}
