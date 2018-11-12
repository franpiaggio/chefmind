<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Overtrue\LaravelFollow\Traits\CanLike;
use Overtrue\LaravelFollow\Traits\CanFavorite;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use CanLike, CanFavorite, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * Relación con tabla de estados
     */
    public function userState(){
        return $this->belongsTo('App\UserState');
    }

    /**
     * Relación con tabla de roles
     */
    public function roles(){
        return $this
            ->belongsToMany('App\Role')
            ->withTimestamps();
    }

    /**
     * Verifica si tiene algún rol asignado
     * Si no lo tiene arroja un error
     */
    public function authorizeRoles($roles){
        if ($this->hasAnyRole($roles)) {
            return true;
        }
        abort(401, 'Esta acción no está autorizada.');
    }

    /**
     * Verifica si tiene un listado o un solo rol
     * En ambos casos verifica que sea válido
     */
    public function hasAnyRole($roles){
        if (is_array($roles)) {
            foreach ($roles as $role) {
                if ($this->hasRole($role)) {
                    return true;
                }
            }
        } else {
            if ($this->hasRole($roles)) {
                return true;
            }
        }
        return false;
    }

    /**
     * Verifica si el rol existe
     */
    public function hasRole($role){
        if ($this->roles()->where('name', $role)->first()) {
            return true;
        }
        return false;
    }

    /**
     * Relación con tabla de recetas
     */
    public function recipes(){
        return $this->hasMany('App\Recipe');
    }

    /**
     * Relación con tabla de recetas
     */
    public function categories(){
        return $this->hasMany('App\Category', 'category_recipe');
    }
}
