<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    /**
     * Datos que se pueden completar
     */
    protected $fillable = [
        'name', 'img'
    ];
    
    /**
     * Asocio Recetas y categorias
     */
    public function recipes(){
        return $this->belongsToMany('App\Recipe', 'category_recipe')->withTimestamps();
    }

    /**
     * Relación con tabla usuarios
     */
    public function user(){
        return $this->belongsTo('App\User');
    }
}
