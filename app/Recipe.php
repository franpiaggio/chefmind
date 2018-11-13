<?php

namespace App;

use Overtrue\LaravelFollow\Traits\CanBeLiked;
use Overtrue\LaravelFollow\Traits\CanBeFavorited;
use Illuminate\Database\Eloquent\Model;

class Recipe extends Model{
    use CanBeLiked, canBeFavorited;

    /**
     * Datos que se pueden completar
     */
    protected $fillable = [
      'title', 'body', 'published_at', 'featured_image', 'time', 'difficulty', 'quantity', 'textpreview'
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
    
    /**
     * Relación con tabla de comments
     */
    public function comments(){
      return $this->hasMany('App\Comment');
    }

    /**
     * Relación con tabla de comments
     */
    public function images(){
      return $this->hasMany('App\Image');
    }
}
