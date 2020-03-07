<?php

namespace App;
use Caffeinated\Shinobi\Traits\ShinobiTrait;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;
    use ShinobiTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'ci', 'nombre', 'paterno', 'materno', 'telefono'
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
     * Get the Person that owns the Usuario.
    */

    public function persona()
    {
        //return $this->belongsTo('App\Persona', 'foreign_key', 'local_key');
        return $this->belongsTo('App\Persona', 'id_persona', 'id_persona');
    }


    public function mesas()
    {
        //return $this->belongsTo('App\Persona', 'foreign_key', 'local_key');
        return $this->belongsToMany('App\Mesa', 'rel_usuario_mesa', 'id_usuario', 'id_mesa');
    }
}
