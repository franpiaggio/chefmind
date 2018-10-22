<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ingredient extends Model
{
    protected $searchableColumns = ['name'];
    /**
     * Datos que se pueden completar
     */
    protected $fillable = ['name'];
    
    /**
     * Asocio Recetas y categorias
     */
    public function recipes(){
        return $this->belongsToMany('App\Recipe')->withTimestamps();
    }
}
